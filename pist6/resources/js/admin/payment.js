/**
 * 【一覧画面】
 * alert制御処理
 */
let url = new URL(window.location.href);
let params = url.searchParams;
if (params.get('upd') == 'success') {
    alert('更新が完了しました。');
}
params.delete('upd');
history.replaceState('', '', url.pathname);


/**
 * 【更新画面】
 * 削除ボタン押下処理
 */
if (document.getElementById('updateBtn') != null) {
    document.getElementById('updateBtn').addEventListener('click', function() {
        if (window.confirm("購入ステータスを変更してよろしいですか？")) {
            document.form.submit();
        }
    });
}
