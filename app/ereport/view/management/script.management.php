const showMessage = function(status, message) {
    $.bootstrapGrowl("<h4><strong>"+message.title+"</strong></h4> <p>"+message.text+"</p>", {
        type: status,
        delay: 3000,
        allow_dismiss: true,
        offset: {from: "top", amount: 20}
    });
}

// Sakter Script
if ($("#satker").length > 0) {
    const satker = new frameduz("#satker");
    const dialog = satker.createDialog("#modal-fade");
    satker.showTable = function(){
        satker.loadTable({
            url: "/ereport/satker/list",
            data: $(".form-table").serialize(),
            onShow: function(content){
                content.find("[data-toggle='tooltip']").tooltip();
                content.find(".btn-edit").each(function(index, element){
                    $(element).on("click", function(e){
                        e.preventDefault();
                        satker.showForm(this.id);
                    });
                });

                content.find(".btn-delete").each(function(index, element){
                    $(element).on("click", function(e){
                        e.preventDefault();
                        const params = {id: this.id, message: this.getAttribute("data-message")};
                        if(confirm(params.message)){
                            const progress = satker.createProgress(satker.table.content);
                            setTimeout(function(){
                                app.sendData({
                                    url: "/ereport/satker/delete",
                                    data: params,
                                    token: "<?= $this->token; ?>",
                                    onSuccess: function(response){
                                        // console.log(response);
                                        progress.remove();
                                        satker.showTable();
                                        showMessage("info", response.message);
                                    },
                                    onError: function(error){
                                        // console.log(error);
                                        progress.remove();
                                        showMessage("danger", error.message);
                                    }
                                });
                            }, 1000);
                        }
                    });
                });
            },
            onPage: function(page_number){
                //console.log(page_number);
                $(".form-table").find("#page").val(page_number);
                satker.showTable();
            }
        });
        // console.clear();
        return false;
    }

    satker.showForm = function(id){
        const form_content = satker.form.clone();
        form_content.attr("id", "form-input");
        // Save Data
        form_content.on("submit", function(event){
            const progress = satker.createProgress(dialog.content);
            setTimeout(function(){
                app.sendData({
                    url: "/ereport/satker/save",
                    data: form_content.serialize(),
                    token: "<?= $this->token; ?>",
                    onSuccess: function(response){
                        //console.log(response);
                        progress.remove();
                        dialog.modal("hide");
                        satker.showTable();
                        showMessage("info", response.message);
                    },
                    onError: function(error){
                        console.log(error);
                        progress.remove();
                        showMessage("danger", error.message);
                    }
                });
            }, 500);
        });
        
        // Load Form
        setTimeout(function(){
            app.sendData({
                url: "/ereport/satker/form",
                data: {id},
                token: "<?= $this->token; ?>",
                onSuccess: function(response){
                    //console.log(response);
                    const data = response.data;
                    const form = data.form;
                    satker.form.createObject(form_content, {
                        id_satker: app.createForm.inputKey("id_satker", form.id_satker),
                        nama_satker: app.createForm.inputText("nama_satker", form.nama_satker).attr("required", true),
                        group_satker: app.createForm.selectOption("group_satker", data.pilihan_group, form.group_satker).addClass("select-select2"),
                        nourut: app.createForm.inputText("nourut", form.nourut).attr("required", true),
                        password: app.createForm.inputText("password", form.password).attr("required", true),
                    });

                    form_content.find(".select-select2").css({width: "100%"}).select2();
                    dialog.title.html(data.form_title);
                    dialog.body.html(form_content);
                    dialog.submit.attr("form", "form-input");
                    dialog.modal("show");
                    
                },
                onError: function(error){
                    console.log(error);
                }
            });
        }, 500);
    }

    satker.modul.find(".filter-table").on("change", function(e){
        e.preventDefault();
        $(".form-table").find("#page").val(1);
        satker.showTable();
    });
    satker.modul.find(".btn-form").on("click", function(e){
        e.preventDefault();
        satker.showForm(this.id);
    });
    satker.modul.find(".btn-reload").on("click", function(e){
        e.preventDefault();
        satker.showTable();
    });

    satker.showTable();
}


// User Script
if ($("#user").length > 0) {
    const user = new frameduz("#user");
    const dialog = user.createDialog("#modal-fade");
    user.showTable = function(){
        user.loadTable({
            url: "/ereport/user/list",
            data: $(".form-table").serialize(),
            onShow: function(content){
                content.find("[data-toggle='tooltip']").tooltip();
                content.find(".btn-edit").each(function(index, element){
                    $(element).on("click", function(e){
                        e.preventDefault();
                        user.showForm(this.id);
                    });
                });
    
                content.find(".btn-delete").each(function(index, element){
                    $(element).on("click", function(e){
                        e.preventDefault();
                        const params = {id: this.id, message: this.getAttribute("data-message")};
                        if(confirm(params.message)){
                            const progress = user.createProgress(user.table.content);
                            setTimeout(function(){
                                app.sendData({
                                    url: "/ereport/user/delete",
                                    data: params,
                                    token: "<?= $this->token; ?>",
                                    onSuccess: function(response){
                                        // console.log(response);
                                        progress.remove();
                                        user.showTable();
                                        showMessage("info", response.message);
                                    },
                                    onError: function(error){
                                        // console.log(error);
                                        progress.remove();
                                        showMessage("danger", error.message);
                                    }
                                });
                            }, 1000);
                        }
                    });
                });
            },
            onPage: function(page_number){
                //console.log(page_number);
                $(".form-table").find("#page").val(page_number);
                user.showTable();
            }
        });
        console.clear();
        return false;
    }
    
    user.showForm = function(id){
        const form_content = user.form.clone();
        form_content.attr("id", "form-input");
        // Save Data
        form_content.on("submit", function(event){
            const progress = user.createProgress(dialog.content);
            setTimeout(function(){
                app.sendData({
                    url: "/ereport/user/save",
                    data: form_content.serialize(),
                    token: "<?= $this->token; ?>",
                    onSuccess: function(response){
                        //console.log(response);
                        progress.remove();
                        if (response.status == "success") {
                            dialog.modal("hide");
                            user.showTable();
                            showMessage("info", response.message);
                        }
                        else{
                            showMessage("danger", response.message);
                        }
                    },
                    onError: function(error){
                        console.log(error);
                        progress.remove();
                        showMessage("danger", error.message);
                    }
                });
            }, 500);
        });
        
        // Load Form
        setTimeout(function(){
            app.sendData({
                url: "/ereport/user/form",
                data: {id},
                token: "<?= $this->token; ?>",
                onSuccess: function(response){
                    //console.log(response);
                    const data = response.data;
                    const form = data.form;
                    user.form.createObject(form_content, {
                        id_user: app.createForm.inputKey("id_user", form.id_user),
                        username: app.createForm.inputText("username", form.username).attr("required", true),
                        group_user: app.createForm.selectOption("group_user", data.pilihan_group, form.group_user).addClass("select-select2").attr("required", true),
                        password: app.createForm.inputText("password", form.password).attr("required", true),
                    });
    
                    form_content.find(".select-select2").css({width: "100%"}).select2();
                    dialog.title.html(data.form_title);
                    dialog.body.html(form_content);
                    dialog.submit.attr("form", "form-input");
                    dialog.modal("show");
                    
                },
                onError: function(error){
                    console.log(error);
                }
            });
        }, 500);
    }
    
    user.modul.find(".filter-table").on("change", function(e){
        e.preventDefault();
        $(".form-table").find("#page").val(1);
        user.showTable();
    });
    user.modul.find(".btn-form").on("click", function(e){
        e.preventDefault();
        user.showForm(this.id);
    });
    user.modul.find(".btn-reload").on("click", function(e){
        e.preventDefault();
        user.showTable();
    });

    user.showTable();
}