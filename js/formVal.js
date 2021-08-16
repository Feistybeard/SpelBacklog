//ser till att alla fält i formuläret är ifyllda innan
//formuläret skickas annars visas ett meddelande
function validateForm() {
  let t = document.forms['form']['title'].value;
  let r = document.forms['form']['release'].value;
  let u = document.forms['form']['imgurl'].value;
  if (t == "" || r == "" || u == "") {
      alert("All Fields Must Be Filled Out");
      return false;
  }
}
