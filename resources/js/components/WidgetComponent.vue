<template>
    <div id="widget">
        <form id="form" @submit.prevent="sendMessage()">
            <div class="row">
                <label for="name">Имя:</label>
                <input type="text" name="name" id="name" v-model="name">
            </div>
            <div class="row">
                <label for="message">Сообщение:</label>
            </div>
            <div class="row">
                <textarea name="message" id="message" v-model="message"></textarea>
            </div>
            <div class="row">
                <button>Отправить</button>
            </div>
        </form>
        <div id="messages">
            <div class="row" v-for="message in messages">
                <b>{{message.name}}</b>: <span v-html="message.message"></span>. <i>({{message.created | formatDate}})</i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messages: [],
                message: '',
                name: '',
            }
        },
        methods: {
            addMessage(messageData) {
                this.messages.unshift(messageData);
            },
            sendMessage() {
                let _this = this;
                window.Client.sendMessage({
                    name: this.name,
                    message: this.message
                }, function(data){
                    _this.addMessage(data);
                })
                _this.message = '';
                return false;
            }
        },
        filters: {
            formatDate: function (d) {
                if (!d) return '';
                d = new Date(d);
                return [
                    [
                        `0${d.getDate()}`.slice(-2),
                        `0${d.getMonth() + 1}`.slice(-2),
                        d.getFullYear(),
                    ].join('.'),
                    [
                        `0${d.getHours()}`.slice(-2),
                        `0${d.getMinutes()}`.slice(-2),
                    ].join(':'),
                ].join(' ');
            }
        },
        mounted() {
            let _this = this;
            window.Client.getMessages(function (data) {
                for (let i = 0; i < data.length; i++) {
                    _this.addMessage(data[i]);
                }
            });
        }
    }
</script>
