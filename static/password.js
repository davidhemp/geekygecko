function checkMatch(){
    var pw = document.getElementById('password').value;
    var pwc = document.getElementById('passwordConfirm').value;
    if (pw === pwc){
        document.getElementById('submitButton').disabled = false;
    } else {
        alert('Passwords do not match');
        document.getElementById('submitButton').disabled = true;
        document.getElementById('password').value = "";
        document.getElementById('passwordConfirm').value = "";
    }
}
