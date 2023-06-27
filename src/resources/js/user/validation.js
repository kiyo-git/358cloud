$(function () {
/**
 * 確認コード６桁
 */
$("#digitCheck").on('click', function () {
    let code = document.getElementById("pin_code").value;
    let form = document.getElementById("veriftySMS")

    if (code.match(/[0-9]{6}/g) != code ) {
      alert('確認コードは6桁で入力してください')
    } else {
      form.submit()
    }
  })
});
