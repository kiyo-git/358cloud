/**
 * 【一覧画面】
 * alert制御処理
 */
let url = new URL(window.location.href);
let params = url.searchParams;
if (params.get('status') == 'success') {
    alert('登録が完了しました。');
} else if (params.get('status') == 'error') {
    alert('登録に失敗しました。');
}
params.delete('status');
history.replaceState('', '', url.pathname);