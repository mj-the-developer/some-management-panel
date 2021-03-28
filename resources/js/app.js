require('./bootstrap');

require('alpinejs');

// Toggle sidebar on tablet and mobile
$(document).ready(function() {
    $('#sidebar-toggler').on('click', function() {
        $('#main-overlay').addClass('active');
        $('.sidebar-wrapper').addClass('active');
    });
    $('#main-overlay').on('click', function() {
        $('#main-overlay').removeClass('active');
        $('.sidebar-wrapper').removeClass('active');
    });
});

// insert commas as thousands separators
function addCommas(n) {
    var rx = /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function (w) {
        while (rx.test(w)) {
            w = w.replace(rx, '$1,$2');
        }
        return w;
    });
}

function addDashes(n) {
    var rx = /(\d+)(\d{4})/;
    return String(n).replace(/^\d+/, function (w) {
        while (rx.test(w)) {
            w = w.replace(rx, '$1-$2');
        }
        return w;
    });
}

// return integers and decimal numbers from input
// optionally truncates decimals- does not 'round' input
function validDigits(n, dec) {
    n = n.replace(/[^\d\.]+/g, '');
    var ax1 = n.indexOf('.'), ax2 = -1;
    if (ax1 != -1) {
        ++ax1;
        ax2 = n.indexOf('.', ax1);
        if (ax2 > ax1) n = n.substring(0, ax2);
        if (typeof dec === 'number') n = n.substring(0, ax1 + dec);
    }
    return n;
}

window.onload = function () {
    let idsToMoneyFormat = ['monthly_need_amount','monthly_rent_amount','home_rent_amount','home_deposit_amount','amount'];

    idsToMoneyFormat.forEach(id => {
        var n1 = document.getElementById(id);
    
        if (n1) {
            n1.onkeyup = n1.onchange = function (e) {
                e = e || window.event;
                var who = e.target || e.srcElement, temp;
                temp = validDigits(who.value);
                who.value = addCommas(temp);
            }
    
            n1.onblur = function () {
                var temp = parseFloat(validDigits(n1.value));
                if (temp) n1.value = addCommas(temp);
            }
    
            if (Boolean(n1.value)) n1.value = addCommas(n1.value);
        }
    });

    let cardInput = document.getElementById('credit_card');

    if (cardInput) {
        cardInput.onkeyup = cardInput.onchange = function (e) {
            e = e || window.event;
            var who = e.target || e.srcElement, temp;
            temp = validDigits(who.value);
            who.value = addDashes(temp);
        }

        cardInput.onblur = function () {
            var temp = parseFloat(validDigits(cardInput.value));
            if (temp) cardInput.value = addDashes(temp);
        }

        if (Boolean(cardInput.value)) cardInput.value = addDashes(cardInput.value);
    }
}
