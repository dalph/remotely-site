const axios = require('axios');
window.Client = {
    id: 0,
    _getPageUid: function(){
        return window.page_uid;
    },
    _getApiUrl: function(){
        return window.api_url;
    },
    _sendData: function (method, params, callback) {
        if (null === params || typeof params !== 'object') params = {};
        params.page_uid = this._getPageUid();
        let id = ++this.id;
        let data = {"jsonrpc": "2.0", "method": method, "params": params, "id": id};
        let url = this._getApiUrl();
        if (!url) {
            alert('url is not set');
            return;
        }
        axios
            .post(url, data)
            .then(function (response) {
                let data = response.data;
                if (data && data.error){
                    alert(data.error.code + ': ' + data.error.message);
                    return;
                }
                if (+data.id !== +id){
                    alert('Wrong id');
                    console.log(id);
                    console.log(data.id);
                }
                if (typeof callback === 'function') {
                    callback(data.result);
                }
            });
    },
    getMessages: function(callback){
        this._sendData('getMessages', null, callback);
    },
    sendMessage: function(params, callback){
        this._sendData('sendMessage', params, callback);
    },
}