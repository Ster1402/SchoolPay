
var formdata = new FormData();
formdata.append("user", "makaebenezer@yahoo.fr");
formdata.append("password", "ecoleenspd2022");
formdata.append("senderid", "SchoolPaY");
formdata.append("sms", "How");
formdata.append("mobiles", "237682092576");

var requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
};

fetch("https://smsvas.com/bulk/public/index.php/api/v1/sendsms", requestOptions)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));
