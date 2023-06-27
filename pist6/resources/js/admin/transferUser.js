/**
 * 【一覧画面】
 * alert制御処理
 */
let url = new URL(window.location.href);
let params = url.searchParams;
if (params.get('status') == 'success') {
    alert('更新が完了しました。');
} else if (params.get('status') == 'error') {
    alert('更新に失敗しました。');
} else if (params.get('status') == 'error.delete') {
    alert('削除に失敗しました。');
 }else if (params.get('status') == 'success.delete') {
    alert('削除しました。');
 }
params.delete('status');
history.replaceState('', '', url.pathname);


/**
 * 【更新画面】
 * 更新ボタン押下処理
 */
if (document.getElementById('updateBtn') != null) {
    document.getElementById('updateBtn').addEventListener('click', function() {
        let update = document.getElementById("update");
        if (window.confirm("このユーザーを本当に更新してよろしいですか？")) {
            update.submit()
        }
    });
}

/**
 * 【更新画面】
 * 削除ボタン押下処理
 */
if (document.getElementById('deleteBtn') != null) {
    document.getElementById('deleteBtn').addEventListener('click', function() {
        let form = document.getElementById("delete");
        if (window.confirm("このユーザーを本当に削除してよろしいですか？")) {
            form.submit()
        }
    });
}

/**
 * 【更新画面】
 * 削除ボタン押下処理
 */
if (document.getElementById('download') != null) {
    document.getElementById('download').addEventListener('click', function() {
        document.form.action = "/admin/transfer-user-search/download";
	    document.form.method = "post";
        document.form.submit();
    });
}
