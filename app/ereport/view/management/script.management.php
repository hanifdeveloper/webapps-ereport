fz = function(id) {
    modul = $(id);
    table = {
        loader: modul.find(".fztable-loader"),
        content: modul.find(".fztable-content"),
        contentTbody: modul.find(".fztable-content .table tbody"),
        contentTbodyRows: modul.find(".fztable-content .table tbody tr"),
        paging: modul.find(".fztable-paging ul"),
        pagingItem: modul.find(".fztable-paging ul li"),
        empty: modul.find(".fztable-empty"),
    };

    createTable = function(data, params){
        table.loader.hide();
        table.empty.hide();

        let contents = data.contents;
        let number = data.number;
        let page = parseInt(data.page);
        let size = data.size;
        let total = data.total;
        let totalpages = data.totalpages;

        if (total > 0) {
            // Create Table Contents
            table.contentTbody.html("");
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
            table.content.show();

            // Create Paging
            table.paging.html("");
            if (totalpages > 1) {
                const prev_page = (page > 1) ? page - 1 : 1;
                const next_page = (page < totalpages) ? page + 1 : totalpages;
                
                const btn_page = table.pagingItem.html();
                const btn_first = table.pagingItem.clone().html(btn_page.replace("{page}", "&laquo;")).find("a").attr("page-number", 1).parent();
                const btn_last = table.pagingItem.clone().html(btn_page.replace("{page}", "&raquo;")).find("a").attr("page-number", totalpages).parent();
                const btn_prev = table.pagingItem.clone().html(btn_page.replace("{page}", "&lsaquo;")).find("a").attr("page-number", prev_page).parent();
                const btn_next = table.pagingItem.clone().html(btn_page.replace("{page}", "&rsaquo;")).find("a").attr("page-number", next_page).parent();
                const btn_dots = table.pagingItem.clone().html(btn_page.replace("{page}", "...")).addClass("disabled");
                const btn_active = table.pagingItem.clone().addClass("active").html(btn_page.replace("{page}", page)).find("a").attr("page-number", "").parent();
                
                if (page > 3) {
                    table.paging.append(btn_first);
                    table.paging.append(btn_prev);
                    table.paging.append(btn_dots);
                }

                for (let p = (page - 2); p < page; p++) {
                    if (p < 1) continue;
                    let pages = table.pagingItem.clone().html(btn_page.replace("{page}", p)).find("a").attr("page-number", p).parent();
                    table.paging.append(pages);
                }

                table.paging.append(btn_active);

                for (let p = (page + 1); p < (page + 3); p++) {
                    if (p > totalpages) break;
                    let pages = table.pagingItem.clone().html(btn_page.replace("{page}", p)).find("a").attr("page-number", p).parent();
                    table.paging.append(pages);
                }

                if ((page + 2) < totalpages) {
                    table.paging.append(btn_dots);
                }

                if (page < (totalpages - 2)) {
                    table.paging.append(btn_next);
                    table.paging.append(btn_last);
                }

                table.paging.show();
                table.paging.find("a[page-number!='']").on("click", function(e) {
                    e.preventDefault();
                    // console.log($(this).attr("page-number"));
                    params.data.page = $(this).attr("page-number");
                    if(typeof params.onPage === "function") params.onPage(params);
                })

            }
        }
        else {
            table.empty.show();
            if(typeof params.onShow === "function") params.onShow(table.content);
        }
    };

    this.createProgress = function(obj) {
        // <div class="fzprogress">
        //     <div class="spinner">
        //         <div class="bar1"></div>
        //         <div class="bar2"></div>
        //         <div class="bar3"></div>
        //         <div class="bar4"></div>
        //         <div class="bar5"></div>
        //         <div class="bar6"></div>
        //         <div class="bar7"></div>
        //         <div class="bar8"></div>
        //         <div class="bar9"></div>
        //         <div class="bar10"></div>
        //         <div class="bar11"></div>
        //         <div class="bar12"></div>
        //     </div>
        // </div>
        const progress = $("<div>").addClass("fzprogress");
        const spinner = $("<div>").addClass("spinner");
        for (let i = 1; i <= 12; i++) {
            $("<div>").addClass("bar"+i).appendTo(spinner);
        }
        spinner.appendTo(progress);
        obj.css("position", "relative").prepend(progress);
        return progress;
        // $("<div>").addClass("bar1").appendTo(spinner);
        // $("<div>").addClass("bar1").appendTo(spinner);
        // $("<div>").addClass("bar1").appendTo(spinner);
        // $("<div>").addClass("bar1").appendTo(spinner);

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
                    // console.log(response);
                    createTable(response.data, params);
                },
                onError: function(error){
                    console.log(error);
                }
            });
        }, 500);
    };
}


const satker = new fz("#satker");
satker.showTable = function(){
    satker.loadTable({
        url: "/ereport/satker/list",
        data: {page: 1, size: 5, cari: "", group: ""},
        onShow: function(){
            //
        },
        onPage: function(params){
            satker.loadTable(params);
        }
    });
}

satker.showTable();
const progress = satker.createProgress($(".fztable-content"));
console.log(progress);