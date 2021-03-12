aduan = {
    init: function(){
        url_path = "<?= $url_path; ?>";

        $(".mydatepicker").daterangepicker({
            singleDatePicker: true,
			showDropdowns: true,
            minYear: 2019,
            // maxYear: 2020,
			autoApply: true,
			locale: {
				format: "DD MMM YYYY"
			}
        }).on("change", function(e){
			e.preventDefault();
            // validate date
            aduan.dateValidate(this.value);
        });
        
        $(".form-complaint").on("submit", function(e){
            e.preventDefault();
            // validate date
            if(aduan.dateValidate($("#complaintDate").val())){
                let formData = $(this)[0];
                app.sendDataMultipart({
                    url: "/complaint/aduan/save",
                    data: formData,
                    token: "<?= $this->token; ?>",
                    onSuccess: function(response){
                        console.info(response);
                        alert(response.message.text);
                        // window.location = response.message.data;
                        window.location.reload();
                    },
                    onError: function(error){
                        console.error(error);
                    }
                });
            }
        });
    },
    dateValidate: function(value){
        const expiredDate = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000);
        const currentDate = new Date();
        const choiceDate = new Date(value);
        if (choiceDate >= currentDate || choiceDate < expiredDate) {
            alert("WAKTU ADUAN TIDAK MEMENUHI SYARAT (LEBIH DARI 7 HARI)");
            return false;
        }

        return true;
    },
};

aduan.init();