/**
 * 住所検索ボタン押下時の制御
 * - 住所の検索
 * - 値のセット
 */
$(function () {
    $("#zip_search").on('click', function () {
        // ajax通信開始
        $.ajax({
            url: "https://zipcloud.ibsnet.co.jp/api/search?limit=1&zipcode=" +$('#zip_code').val(),
            // 現在のドメインと、データ取得先のドメインが異なるため 'jsonp' を指定
            dataType: 'jsonp',
        }).then(
            // 通信成功時の処理
            function (data) {
                if (data.status == '200' && data.results != null) {
                    // debug_mode
                    // console.log(data);

                    // エラー文の削除
                    $('#zip_err').text('');

                    // 住所情報を取得
                    let result = data.results[0];
                    // すでに選択されていたものは、選択解除
                    $('[data-prefcode]').prop('selected', false);

                    // 都道府県
                    let prefcode = result.prefcode;
                    $('[data-prefcode="' + prefcode + '"]').prop('selected', true);
                    // 市区町村
                    $('#city').val(result.address2);
                    // 住所
                    $('#block').val(result.address3);
                } else {
                    $('#zip_err').text('住所が見つかりません。');
                }
            },
            // 通信失敗時の処理
            function () {
                $('#zip_err').text('読み込み失敗。再度お試しください。');
            }
        );
    });
});

/**
 * 郵便番号の変更を検知し、submitボタンを制御
 * - 存在しない郵便番号：disabled
 * - 存在する郵便番号　：disabled解除
 */
// $(function () {
//     $("#zip_code").on('change', function () {
//         $.ajax({
//             url: "https://zipcloud.ibsnet.co.jp/api/search?limit=1&zipcode=" +$('#zip_code').val(),
//             // 現在のドメインと、データ取得先のドメインが異なるため 'jsonp' を指定
//             dataType: 'jsonp',
//         }).then(
//             // 通信成功時の処理
//             function (data) {
//                 if (data.status == '200' && data.results != null) {
//                     console.log('200');
//                     console.log(data);
//                     $('#form_btn').prop("disabled", false);
//                     $('#zip_exist').text('');
//                 } else {
//                     console.log('!200');
//                     console.log(data);
//                     $('#form_btn').prop("disabled", true);
//                     $('#zip_exist').text('存在しない郵便番号が入力されています。');
//                 }
//             },
//             // 通信失敗時の処理
//             function () {
//                 $('#zip_exist').text('読み込み失敗。再度お試しください。');
//             }
//         );
//     });
// });