fz = function(id) {
    modul = $(id);
    table = {
        loader: modul.find(".fztable-loader"),
        content: modul.find(".fztable-content"),
        contentTbody: modul.find(".fztable-content .table tbody"),
        contentTbodyRows: modul.find(".fztable-content .table tbody tr"),
        paging: modul.find(".fztable-paging"),
        empty: modul.find(".fztable-empty"),
    };

    createTable = function(data, callback){
        table.content.show();
        table.loader.hide();
        table.paging.hide();
        table.empty.hide();
        callback.onShow();

        let contents = data.contents;
        let number = data.number;
        let page = data.page;
        let size = data.size;
        let total = data.total;
        let totalpages = data.totalpages;

        table.contentTbody.html("");
        if (total > 0) {
            for (let rows in contents) {
                let row = table.contentTbodyRows.clone();
                let result = row.html().replace("{number}", number++);
                json = contents[rows];
                for (key in json) {
                    var find = new RegExp("{"+key+"}", "g");
                    result = result.replace(find, json[key]);
                    row.html(result);
                }
                table.contentTbody.append(row);
            }
        }
        console.log(contents);
        if(typeof callback.onShow === "function") callback.onShow();
        if(typeof callback.onPage === "function") callback.onPage();
    };

    this.loadTable = function(params) {
        table.loader.show();
        table.content.hide();
        table.paging.hide();
        table.empty.hide();
        setTimeout(function(){
            app.sendData({
                url: params.url,
                data: params.data,
                token: "<?= $this->token; ?>",
                onSuccess: function(response){
                    console.log(response);
                    createTable(response.data, params);
                },
                onError: function(error){
                    console.log(error);
                }
            });
        }, 1000);
    }
}


const satker = new fz("#satker");
satker.showTable = function(){
    satker.loadTable({
        url: "/ereport/satker/list",
        data: {page: 1, cari: "", group: ""},
        onShow: function(){
            //
        },
        onPage: function(){
            //
        }
    });
}

satker.showTable();