const satker = new frameduz("#satker");
const dialog = satker.createDialog("#modal-fade");
const showMessage = function(status, message) {
    $.bootstrapGrowl("<h4><strong>"+message.title+"</strong></h4> <p>"+message.text+"</p>", {
        type: status,
        delay: 3000,
        allow_dismiss: true,
        offset: {from: "top", amount: 20}
    });
}

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
                                    showMessage("danger", response.message);
                                }
                            });
                        }, 1000);
                    }
                });
            });
        },
        onPage: function(page_number){
            $(".form-table").find("#page").val(page_number);
            $(".form-table").submit();
        }
    });
    console.clear();
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
                    console.log(response);
                    progress.remove();
                    dialog.modal("hide");
                    satker.showTable();
                    showMessage("info", response.message);
                },
                onError: function(error){
                    console.log(error);
                    progress.remove();
                    showMessage("danger", response.message);
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
                console.log(response);
                const data = response.data;
                const form = data.form;
                satker.form.createObject(form_content, {
                    id_satker: app.createForm.inputKey("id_satker", form.id_satker),
                    nama_satker: app.createForm.inputText("nama_satker", form.nama_satker).attr("required", true),
                    group_satker: app.createForm.selectOption("group_satker", data.pilihan_group, form.group_satker).addClass("select-select2"),
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

satker.showTable();
satker.modul.find(".filter-table").on("change", function(e){
    e.preventDefault();
    $(".form-table").find("#page").val(1);
    satker.showTable();
});
satker.modul.find(".btn-form").on("click", function(e){
    e.preventDefault();
    satker.showForm(this.id);
});