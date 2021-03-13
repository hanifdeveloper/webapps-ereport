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
        onShow: function(){
            //
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
                // console.log(response);
                const data = response.data;
                const form = data.form;
                satker.form.createObject(form_content, {
                    id_satker: app.createForm.inputKey("id_satker", form.id_satker),
                    nama_satker: app.createForm.inputText("nama_satker", form.nama_satker).attr("required", true),
                    password: app.createForm.inputText("password", form.password).attr("required", true),
                });

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
satker.modul.find("#cari").on("input", function(e){
    e.preventDefault();
    $(".form-table").find("#page").val(1);
});
satker.modul.find(".btn-form").on("click", function(e){
    e.preventDefault();
    satker.showForm(this.id);
    // console.log(satker.form);
});