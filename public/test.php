<script>
var xhr = new XMLHttpRequest ();
xhr.open ("GET", "https://platform.clickatell.com/messages/http/send?apiKey=g92rMBo_SxqcfWxUHRmy7Q ==&to=33782815468&content=h", true);
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log ('success')
    }
};
xhr.send ();
                            


/*
var xhr = new XMLHttpRequest (),
body = JSON.stringify (
    {
        "messages": [
            {
                "channel": "whatsapp",
                "à": "0782815468",
                "content": "Test du texte du message WhatsApp"
            },
            {
                "channel": "sms",
                "à": "0782815468",
                "content": "Test SMS Message Text"
            }
        ]
    }
)
xhr.open ('POST', 'https://platform.clickatell.com/v1/message', true);
xhr.setRequestHeader ('Content-Type', 'application / json');
xhr.setRequestHeader ('Authorization', 'nO47-6k9RDmETPU3VmmYIg ==');
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log ('success');
    }
};

xhr.send (body);
            

*/

</script>