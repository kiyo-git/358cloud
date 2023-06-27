let setOrderIdButton = document.querySelector(".set-order-id");
if (setOrderIdButton != null) {
    setOrderIdButton.addEventListener("click", function () {
        let orderId = "dummy" + (new Date().getTime()).toString();
        let id = this.dataset.bind;
        document.getElementById(id).value = orderId;
    })
}

let proceedPaymentButton = document.getElementById("proceed_payment");
if (proceedPaymentButton != null) {
    proceedPaymentButton.addEventListener("click", function () {
        // 既存カードのフロー
        // tokenを取得せずにsubmitする
        if (document.querySelector('input[name="cardId"]:checked').value != 'newCard') {
            document.getElementById('canSubmit').value = "true";
            document.forms[0].submit();
            return;
        }

        // 新規カードのフロー
        var data = {};
        data.token_api_key = document.getElementById('token_api_key').value;
        if (document.getElementById('card_number')) {
            data.card_number = document.getElementById('card_number').value;
        }
        if (document.getElementById('cc_exp_mm') && document.getElementById('cc_exp_yy')) {
            data.card_expire = document.getElementById('cc_exp_mm').value + '/' + document.getElementById('cc_exp_yy').value;
            console.log(data.card_expire);
        }
        if (document.getElementById('cc_csc')) {
            data.security_code = document.getElementById('cc_csc').value;
        }
        if (document.getElementById('cardholderName')) {
            data.cardholder_name = document.getElementById('cardholderName').value;
        }

        data.lang = "ja";

        let url = "https://api.veritrans.co.jp/4gtoken";

        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
        xhr.addEventListener('loadend', function () {
            if (xhr.status === 0) {
                alert("トークンサーバーとの接続に失敗しました");
                return;
            }
            let response = JSON.parse(xhr.response);
            // console.log(response);
            if (xhr.status === 200) {
                document.getElementById('card_number').value = "";
                document.getElementById('cc_exp_mm').value = "";
                document.getElementById('cc_exp_yy').value = "";
                document.getElementById('cc_csc').value = "";
                if (document.getElementById('cardholderName')) {
                    document.getElementById('cardholderName').value = "";
                }
                document.getElementById('token').value = response.token;
                document.getElementById('canSubmit').value = "true";
                document.forms[0].submit();
            } else {
                // alert(response.message);
                document.getElementById('authorization_comment').innerText = response.message;
            }
        });
        xhr.send(JSON.stringify(data));
    })
}

// todo: taskdo mdkTokenの話題ではないためファイル分離を検討する
// todo: taskdo fetchをXHRで書き直す。
function requestRemoveCard(url, csrfToken, removeCardId, removeCardNumber, confirmMessage) {
    let cardRemoveAgreed = confirm(confirmMessage.replace("#0", "****-****-****-" + removeCardNumber.slice(12, 16)));
    if (!cardRemoveAgreed) {
        return;
    }

    let fetchInit = {
        method: 'delete',
        credentials: 'include',
        mode: 'cors',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json; charset=utf-8'
        },
        body: JSON.stringify({ 'card_id': removeCardId })
    }

    fetch(url, fetchInit)
        .then((response) => response.json() )
        .then((jsonBody) => {
            // 成功時のメッセージ表示
            alert(jsonBody['message'].replace("#0", "****-****-****-" + removeCardNumber.slice(12, 16)));

            document.getElementById('cardSection' + removeCardId).style.display = 'none';
            // チェックボックスで選択しているカードを削除する場合、新しいカードにチェックを移す
            if (document.querySelector('input[name="cardId"]:checked').value == removeCardId) {
                document.getElementById("paychoiceNewCard").checked = true;
            }
        })
        .catch(jsonBody => {
            // 失敗時のメッセージ表示
            alert(jsonBody['message'].replace("#0", "****-****-****-" + removeCardNumber.slice(12, 16)));
        });
}

// Viteに消されないようにwindowに持っておく
window.requestRemoveCard = requestRemoveCard;
