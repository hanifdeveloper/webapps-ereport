var api_url = "<?= $url_path; ?>";
app = {
    initModul: function(id) {
        project = $(id);
        modalForm = $(".form-modal-input");
        result = {
            table: {
                action: project.find(".frmData"),
                loader: project.find(".table-loader"),
                content: project.find(".table-content"),
                empty: project.find(".table-empty"),
                tbody: project.find(".table-content .table tbody"),
                tbodyRows: project.find(".table-content .table tbody tr"),
                pagging: project.find(".table-content .table-pagging ul.pagination"),
                paggingItem: project.find(".table-content .table-pagging ul.pagination .page-item"),
                count: project.find(".table-content .count"),
                query: project.find(".query"),
            },
            form: {
                action: project.find(".frmInput"),
                title: project.find(".form-title"),
                content: project.find(".form-contents"),
                loader: project.find(".form-loader"),
                button: project.find(".form-button"),
                objectForm: project.find(".form-content").clone().html(),
            },
            formModal: {
                modal: modalForm,
                action: modalForm.find(".frmInput"),
                title: modalForm.find(".form-modal-title"),
                content: modalForm.find(".form-modal-content"),
                loader: modalForm.find(".form-modal-loader"),
                button: modalForm.find(".form-modal-button"),
                objectForm: project.find(".form-content").clone().html(),
            }
        }
        project.find(".form-content").hide();
        return result;
    },
    // Custom Active Url
    initMenuActiveUrl: function(pageUrl) {
        var macthUrl = []
        $("ul.sidebar-menu a").each(function(k, v){
            if(pageUrl.match(this.href)) macthUrl.push(this);
        });
        var element = $(macthUrl[macthUrl.length - 1]);
        element.addClass("active").parent().addClass("active").parent().addClass("show").parent().addClass("active open");
    },
    // Custom Error Message
    showErrMessage: function(params){
        var type = (params.status == "error") ? "bg-danger" : "bg-success";
        var errMessage = $("<div>").attr({class: "alert alert-dismissible "+type+" text-white border-0", role: "alert"});
        var closeButton = $("<button>").attr({type: "button", class: "close", "data-dismiss": "alert", "aria-label": "Close"}).html("<span aria-hidden='true'>×</span>")
        var message = $("<span>").html("<strong>"+params.message.title+"</strong> "+params.message.text);
        return errMessage.append(closeButton).append(message);
    },
    createTable: function(params){
        var tview = params.table
        var number = params.data.no;
        var table = params.data.table;
        tview.tbody.html("");
        tview.pagging.html("");
        tview.count.text(params.data.count+" "+params.data.label);
        if(params.data.query != "") tview.query.html("<code>"+params.data.query+"</code>");
        if(params.data.count > 0){
            for(var rows in table){
                var row = tview.tbodyRows.clone();
                var result = row.html().replace("{no}", number++);
                json = table[rows];
                for(key in json){
                    var find = new RegExp("{"+key+"}", "g");
                    result = result.replace(find, json[key]);
                    row.html(result);
                }
                tview.tbody.append(row);
            }

            tview.content.show();
            params.onShow(tview.content);
            // Create pagging table
            var page = parseInt(params.data.page);
            var total_pages = Math.ceil(params.data.count / params.data.limit);
            var prev_number = (page > 1) ? page - 1 : 1;
            var next_number = (page < total_pages) ? page + 1 : total_pages;
            var page_number = tview.paggingItem.html();
            
            var btn_first = tview.paggingItem.clone().attr("number-page", 1).html(page_number.replace("{page}", "&laquo;"));
            var btn_last = tview.paggingItem.clone().attr("number-page", total_pages).html(page_number.replace("{page}", "&raquo;"));
            var btn_prev = tview.paggingItem.clone().attr("number-page", prev_number).html(page_number.replace("{page}", "&lsaquo;"));
            var btn_next = tview.paggingItem.clone().attr("number-page", next_number).html(page_number.replace("{page}", "&rsaquo;"));
            var btn_dots = tview.paggingItem.clone().addClass("disabled").html(page_number.replace("{page}", "..."));
            var btn_active = tview.paggingItem.clone().addClass("active").html(page_number.replace("{page}", page));
            
            if(total_pages > 1){
                if(page > 3){
                    tview.pagging.append(btn_first);
                    tview.pagging.append(btn_prev);
                    tview.pagging.append(btn_dots);
                }

                for(i = (page - 2); i < page; i++){
                    if(i < 1) continue;
                    var pages = tview.paggingItem.clone().attr("number-page", i).html(page_number.replace("{page}", i));
                    tview.pagging.append(pages);
                }

                tview.pagging.append(btn_active);

                for(i = (page + 1); i < (page + 3); i++){
                    if(i > total_pages) break;
                    var pages = tview.paggingItem.clone().attr("number-page", i).html(page_number.replace("{page}", i));
                    tview.pagging.append(pages);
                }

                if((page + 2) < total_pages) tview.pagging.append(btn_dots);
                
                if(page < (total_pages - 2)){
                    tview.pagging.append(btn_next);
                    tview.pagging.append(btn_last);
                }
                
                // action page button
                tview.content.find(".pagging[number-page!='']").on("click", function(event){
                    event.preventDefault();
                    var page = $(this).attr("number-page");
                    params.onPagging(page);
                });
            }
        }else{
            tview.empty.show();
        }
    },
    createForm: {
        inputKey: function(id, value){
            return $("<input>").attr({type: "hidden", id: id, name: id, value: value});
        },
        inputText: function(id, value){
            return $("<input>").attr({type: "text", id: id, name: id, value: value, class: "form-control"});
        },
        inputPassword: function(id, value){
            return $("<input>").attr({type: "password", id: id, name: id, value: value, class: "form-control"});
        },
        textArea: function(id, value){
            return $("<textarea>").attr({id: id, name: id, value: value, class: "form-control"});
        },
        selectOption: function(id, data, value){
            var group = $("<div>");
            var select = $("<select>").attr({id: id, name: id, class: "form-control custom-select", style: "cursor: pointer;"});
            var value = value.split(",");
            $.each(data, function(key, val){
                var option = $("<option>").attr({value: key, selected: ($.inArray(key, value) != -1)}).text(val.text)
                select.append(option);
            });
            group.append(select);
            return group.children();
        },
        radioButton: function(id, data, value){
            var group = $("<div>");
            $.each(data, function(key, val){
                var radio = $("<input>").attr({type: "radio", id: id, name: id, value: key, checked: (key == value)});
                var label = $("<label>").attr("style", "color: #000; cursor: pointer; margin: 10px;").append(radio).append(" "+val.text);
                group.append(label);
            });
            return group.children();
        },
        checkBox: function(id, data, value){
            var group = $("<div>");
            var value = value.split(",");
            $.each(data, function(key, val){
                var check = $("<input>").attr({type: "checkbox", id: id, name: id, value: val, checked: ($.inArray(val, value) != -1)});
                var label = $("<label>").attr("style", "color: #000; cursor: pointer; margin: 5px;").append(check).append(" "+val);
                group.append(label);
            });
            return group.children();
        },
        uploadImage: function(id, image, mimes, desc){
            var group = $("<div>");
            var preview = $("<div>").attr({class: "image-preview"}).html('<img src="'+image+'" class="img-responsive thumbnail" alt="image" width="100%">');
            var file = $("<input>").attr({type: "file", id: id, name: id, class: "file-image", style: "display: none;", accept: mimes});
            var button = $("<label>").attr({for: id, class: "btn btn-block btn-sm btn-dark", style: "cursor: pointer; margin-top: 10px;"}).html("UPLOAD");
            var desc = $("<small>").attr({class: "help-block"}).html(desc);
            group.append(preview).append(file).append(button).append(desc);
            return group.html();
        },
    },
    updateForm: {
        selectOption: function(obj, data, value){
            obj.html("");
            var value = (value == "") ? "" : value.split(",");
            $.each(data, function(key, val){
                var option = $("<option>").attr({value: key, selected: ($.inArray(key, value) != -1)}).text(val.text);
                if(key == "") obj.prepend(option);
                else obj.append(option);
            });
        },
    },
    imagePreview: function(obj){
        if(obj.files && obj.files[0]){
            var reader = new FileReader();
            var preview = $(obj).siblings(".image-preview");
            reader.onload = function(e){
                preview.html('<img src="'+e.target.result+'" class="img-responsive thumbnail" alt="image" width="100%">');
            };
            reader.readAsDataURL(obj.files[0]);
        }
    },
    sendData: function(params){
        var token = (params.token == undefined) ? "app_token" : params.token;
        $.ajax({
            url: api_url+params.url,
            type: "POST",
            data: params.data,
            headers: {"Token": token},
            dataType: "json",
            async: false,
            success: params.onSuccess,
            error: function (e) {
                // console.log(e);
                if(e.status !== 200){
                    if(typeof params.onError === "function") params.onError(e.responseJSON);
                }
            }
        });
    },
    sendDataMultipart: function(params){
        var token = (params.token == undefined) ? "app_token" : params.token;
        $.ajax({
            url: api_url+params.url,
            type: "POST",
            enctype: "multipart/form-data",
            data: new FormData(params.data),
            headers: {"Token": token},
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            datatype: "json",
            xhr: function () {
                var jxhr = null;
                if(window.ActiveXObject) 
                    jxhr = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                else
                    jxhr = new window.XMLHttpRequest();

                if(jxhr.upload) {
                    jxhr.upload.addEventListener("progress", function (evt) {
                        if(evt.lengthComputable) {
                            let percent = Math.round((evt.loaded / evt.total) * 100);
                            if(typeof params.onProgress === "function") params.onProgress(percent);
                        }
                    }, false);
                }
                return jxhr;
            },
            success: params.onSuccess,
            error: function (e) {
                // console.log(e);
                if(e.status !== 200){
                    if(typeof params.onError === "function") params.onError(e.responseJSON);
                }
            }
        });
    },
}

frameduz = function(id) {
    modul = $(id);
    // if (modul.length == 0) return;
    table = {
        content: modul.find(".fztable-content"),
        contentTbody: modul.find(".fztable-content .table tbody"),
        contentTbodyRows: modul.find(".fztable-content .table tbody tr"),
        paging: modul.find(".fztable-paging ul"),
        pagingItem: modul.find(".fztable-paging ul li"),
        totalData: modul.find(".total-data"),
        // empty: modul.find(".fztable-empty"),
        empty: function() {
            let tableEmpty = null;
            if (modul.find(".fztable-empty").length > 0) {
                tableEmpty = modul.find(".fztable-empty");
            }
            else {
                // <div class="fztable-empty">
                //     <div class="alert alert-danger alert-dismissable">
                //         <p><strong>Data tidak ditemukan !</strong></p>
                //     </div>
                // </div>
                tableEmpty = $("<div>").addClass("fztable-empty").html('<div class="alert alert-danger alert-dismissable"><p><strong>Data tidak ditemukan !</strong></p></div>');
                modul.append(tableEmpty);
            }

            return tableEmpty;
        },
        loader: function() {
            let tableLoader = null;
            if (modul.find(".fztable-loader").length > 0) {
                tableLoader = modul.find(".fztable-loader");
            }
            else {
                // <div class="fztable-loader">
                //     <div class="bounce1"></div>
                //     <div class="bounce2"></div>
                //     <div class="bounce3"></div>
                // </div>
                tableLoader = $("<div>").addClass("fztable-loader").html('<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>');
                modul.append(tableLoader);
            }
            
            return tableLoader;
        }
    }

    createTable = function(data, params) {
        table.loader().hide();
        table.empty().hide();

        let contents = data.contents;
        let number = data.number;
        let page = parseInt(data.page);
        let size = data.size;
        let total = data.total;
        let totalpages = data.totalpages;

        table.totalData.html(total);
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
            if(typeof params.onShow === "function") params.onShow(table.content);

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
                    // params.data.page = $(this).attr("page-number");
                    // if(typeof params.onPage === "function") params.onPage(params);
                    const page_number = $(this).attr("page-number")
                    if(typeof params.onPage === "function") params.onPage(page_number);
                })

            }
        }
        else {
            table.empty().show();
        }
    }

    this.form = modul.find(".fzform-content").clone().show();
    this.form.createObject = function(form_content, object) {
        $.each(object, (key, val) => form_content.find("span[data-form-object='"+key+"']").replaceWith(val));
    }

    this.loadTable = function(params) {
        table.loader().show();
        table.empty().hide();
        table.content.hide();
        table.paging.hide();
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
                    alert(error.message.text);
                }
            });
        }, 500);
    }

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
    }

    this.createDialog = function(id) {
        const modal = $(id);
        modal.content = modal.find(".modal-content");
        modal.title = modal.find(".modal-title");
        modal.body = modal.find(".modal-body");
        modal.footer = modal.find(".modal-footer");
        modal.submit = modal.footer.find("button[type='submit']");
        return modal;
    }

    this.modul = modul;
    this.table = table;
}


app.initMenuActiveUrl(window.location.toString());