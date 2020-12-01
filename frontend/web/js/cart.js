$(document).ready(function () {
    function getAddToCartUrl() {
        return $('#add-to-cart-url').val();
    }

    function getRemoveFromCartUrl() {
        return $('#remove-from-cart-url').val();
    }

    function getChangeCountUrl() {
        return $('#change-count-on-cart-url').val();
    }

    function loaderSm() {
        return '<img src="/images/loading-sm.gif">';
    }

    productFlyToCart();

    function cartAjax(url, data = '', showSuccessMessage = false, showErrorMessage = true) {
        $.ajax({
            url: url, data: data, type: 'get', success: function (result) {
                var data = JSON.parse(result)
                if (data.success) {
                    if (showSuccessMessage && data.message) {
                        toastr.info(data.message);
                    }
                    $('#cart-modal-container').html(data.cartModalContent)
                    $('#cart-rassrochka-modal-container').html(data.cartRassrochkaModalContent)
                    $('.cart-items-count').html(data.countItems)
                } else {
                    if (showErrorMessage && data.message) {
                        toastr.error(data.message);
                    }
                }
            }, error: function (result) {
                toastr.error('Xatolik yuz berdi!')
            }
        })
    }

    $(document).on('click', '.add-to-cart', function (e) {
        var url = getAddToCartUrl()
        var productId = $(this).data('product-id')
        cartAjax(url, {'id': productId});
    })
    $(document).on('click', '.remove-from-cart', function (e) {
        var url = getRemoveFromCartUrl()
        var productId = $(this).data('product-id')
        cartAjax(url, {'id': productId});
    })
    $(document).on('click', '.minus-from-cart', function (e) {
        var span = $(this).parent().find('.value')
        var count = span.html()
        if (count <= 1) {
            return false;
        }
        count--;
        var url = getChangeCountUrl()
        var productId = span.data('product-id')
        cartAjax(url, {'id': productId, 'count': count});
    })
    $(document).on('click', '.plus-to-cart', function (e) {
        var span = $(this).parent().find('.value')
        var count = span.html()
        if (count < 1) {
            count = 1;
        }
        count++;
        var url = getChangeCountUrl()
        var productId = span.data('product-id')
        cartAjax(url, {'id': productId, 'count': count});
    })


    /*Rassrochka functions*/


    function calc(summ, summ_r) {

        var prePay = 0;

        var sumUniredMonth = format(round1000((Number(summ) / 0.78) / 12)) + ' сум';
        var sumUnired = format(round1000((Number(summ) / 0.78))) + ' сум';

        if (Number(summ_r) > 0) {
            var rassrochka = Number(summ) / 0.78;
            if (rassrochka > Number(summ_r)) {
                prePay = rassrochka - Number(summ_r);
                prePay = format(round1000(prePay * 0.78)) + ' сум'
            }

            if (Number(summ_r) < 1200000)
                sumUniredMonth = sumUnired = 'Низкая заработная плата';

            if (Number(summ) > 18000000) {
                prePay = (Number(summ) - Number(summ_r)) * 0.78;
                prePay = format(round1000(prePay)) + ' сум';
                var sumUniredMonth = format(round1000(18000000 / 12)) + ' сум';
            }

            if (Number(summ) < 8999999 && Number(summ_r) < 1200000) {
                sumUniredMonth = sumUnired = 'Низкая заработная плата';
            }

            if (Number(rassrochka) > Number(summ_r)) {
                sumUniredMonth = Number(summ_r) / 12;
            }
            if (Number(rassrochka) < Number(summ_r)) {
                sumUniredMonth = Number(rassrochka) / 12;
            }

            sumUniredMonth = format(round1000(sumUniredMonth))

        } else {
            if (Number(summ) > 18000000 && Number(summ) > Number(summ_r)) {
                prePay = (Number(summ) - 18000000) * 0.78;
                prePay = format(round1000(prePay)) + ' сум';
                var sumUniredMonth = format(18000000 / 12)
            }

            if (Number((Number(summ) / 0.78)) > 18000000) {
                var sumUniredMonth = format(round1000(18000000 / 12)) + ' сум';
            }

            if (round1000((Number(summ) / 0.78)) > 18000000) {
                prePay = round1000(((Number(summ) / 0.78) - 18000000) * 0.78); // 18 078 000 - 18 000 000 ) * 0.78
                prePay = format(round1000(prePay)) + ' сум';
            }
        }

        var textInstallment = '';
        if (Number(summ_r) == 0) {
            textInstallment = ' с учетом максимального лимита';
        }

        var result =
            '<label for="exampleInputEmail1">Сумма рассрочки:<span class="attention">' + textInstallment + '</span></label><br>' +
            '<table id="totalSumm" class="table unired-red">\n' +
            '    <thead class="">\n' +
            '       <tr>\n' +
            '           <th scope="col">#</th>\n' +
            '           <th scope="col">Организация</th>\n' +
            '           <th scope="col">Бонус</th>\n' +
            '           <th scope="col">Предоплата</th>\n' +
            '           <th scope="col">Период (месяцы)</th>\n' +
            '           <th scope="col">Ежемесячный платеж</th>\n' +
            '           <th scope="col">Сумма общей оплаты</th>\n' +
            '       </tr>\n' +
            '   </thead>\n' +
            '   <tbody>\n' +
            '       <tr>\n' +
            '           <th scope="row">1</th>\n' +
            '           <td>Unired</td>\n' +
            '           <td>0</td>\n' +
            '           <td>' + prePay + '</td>\n' +
            '           <td>12</td>\n' +
            '           <td>' + sumUniredMonth + '</td>\n' +
            '           <td>' + sumUnired + '</td>\n' +
            '       </tr>\n' +
            '       </tbody>\n' +
            ' </table>';

        var intZm3 = round1000(Number(summ) + (Number(summ) / 100 * 11));
        var intZm6 = round1000(Number(summ) + (Number(summ) / 100 * 26));
        var intZm9 = round1000(Number(summ) + (Number(summ) / 100 * 36));
        var zmarket_3 = format(intZm3) + ' сум';
        var zmarket_6 = format(intZm6) + ' сум';
        var zmarket_9 = format(intZm9) + ' сум';

        var zmarket_3_month = format(round1000(((Number(summ) + Number(summ) / 100 * 11) / 3))) + ' сум';
        var zmarket_6_month = format(round1000(((Number(summ) + Number(summ) / 100 * 26) / 6))) + ' сум';
        var zmarket_9_month = format(round1000(((Number(summ) + Number(summ) / 100 * 36) / 9))) + ' сум';

        if (Number(summ_r) > 0 && Number(summ_r) < 800000)
            zmarket_3 = zmarket_6 = zmarket_9 = zmarket_3_month = zmarket_6_month = zmarket_9_month = 'Низкая заработная плата';
        if (Number(summ) > 8000000)
            zmarket_3 = zmarket_6 = zmarket_9 = zmarket_3_month = zmarket_6_month = zmarket_9_month = 'Превышен лимит кредита';

        if (Number(intZm3) > 8000000)
            zmarket_3 = zmarket_3_month = 'Превышен лимит кредита';
        if (Number(intZm6) > 8000000)
            zmarket_6 = zmarket_6_month = 'Превышен лимит кредита';
        if (Number(intZm9) > 8000000)
            zmarket_9 = zmarket_9_month = 'Превышен лимит кредита';


        var resultMarket =
            '<label for="exampleInputEmail1">Сумма рассрочки:<span class="attention">' + textInstallment + '</span></label><br>' +
            '<table id="totalSumm" class="table zmarket-green">\n' +
            '   <thead class="">\n' +
            '       <tr>\n' +
            '           <th scope="col">#</th>\n' +
            '           <th scope="col">Организация</th>\n' +
            '           <th scope="col">Бонус</th>\n' +
            '           <th scope="col">Предоплата</th>\n' +
            '           <th scope="col">Период (месяцы)</th>\n' +
            '           <th scope="col">Ежемесячный платеж</th>\n' +
            '           <th scope="col">Сумма общей оплаты</th>\n' +
            '       </tr>\n' +
            '   </thead>\n' +
            '   <tbody>\n' +
            '       <tr>\n' +
            '           <th scope="row">1</th>\n' +
            '           <td>Z Market</td>\n' +
            '           <td>0</td>\n' +
            '           <td>0</td>\n' +
            '           <td>3</td>\n' +
            '           <td>' + zmarket_3_month + '</td>\n' +
            '           <td>' + zmarket_3 + '</td>\n' +
            '       </tr>\n' +
            '       <tr>\n' +
            '           <th scope="row">2</th>\n' +
            '           <td>Z Market</td>\n' +
            '           <td>0</td>\n' +
            '           <td>0</td>\n' +
            '           <td>6</td>\n' +
            '           <td>' + zmarket_6_month + '</td>\n' +
            '           <td>' + zmarket_6 + '</td>\n' +
            '       </tr>\n' +
            '       <tr>\n' +
            '           <th scope="row">3</th>\n' +
            '           <td>Z Market</td>\n' +
            '           <td>0</td>\n' +
            '           <td>0</td>\n' +
            '           <td>9</td>\n' +
            '           <td>' + zmarket_9_month + '</td>\n' +
            '           <td>' + zmarket_9 + '</td>\n' +
            '       </tr>\n' +
            '  </tbody>\n' +
            '  </table>';
        return {
            'unired': result,
            'zmarket': resultMarket
        };
    }

    function calcTrandy(summ, debt) {

        // summ = summ.replace(/\s/g, '');
        // debt = debt.replace(/\s/g, '');

        var start = getData(summ, debt, 15, 1, 'start');
        var start_sum = format(Math.ceil(summ));

        var member = getData(summ, debt, 15, 1, 'member');
        var classic = getData(summ, debt, 15, 3, 'classic');
        var silver = getData(summ, debt, 10, 7, 'silver');
        var gold = getData(summ, debt, 5, 10, 'gold');
        var platinum = getData(summ, debt, 0, 12, 'platinum');

        var result =
            '<label for="exampleInputEmail1">Сумма рассрочки:</label><br>' +
            '<table class="table trendy-black">\n' +
            '            <thead class="">\n' +
            '               <tr>\n' +
            '                   <th scope="col">#</th>\n' +
            '                   <th scope="col">Карта</th>\n' +
            '                   <th scope="col">Бонус</th>\n' +
            '                   <th scope="col">Предоплата</th>\n' +
            '                   <th scope="col">Период (месяцы)</th>\n' +
            '                   <th scope="col">Ежемесячный платеж</th>\n' +
            '                   <th scope="col">Сумма общей оплаты</th>\n' +
            '               </tr>\n' +
            '            </thead>\n' +
            '            <tbody>\n' +
            '               <tr>\n' +
            '                   <th scope="row">1</th>\n' +
            '                   <td>Start</td>\n' +
            '                   <td>1% / ' + start['bonus'] + ' сум</td>\n' +
            '                   <td><!--15% /--> ' + start['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + start['month'] + ' сум</td>\n' +
            '                   <td>' + start_sum + ' сум</td>\n' +
            '               </tr>\n' +
            '               <tr>\n' +
            '                   <th scope="row">2</th>\n' +
            '                   <td>Member</td>\n' +
            '                   <td>1% / ' + member['bonus'] + ' сум</td>\n' +
            '                   <td><!--15% /--> ' + member['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + member['month'] + ' сум</td>\n' +
            '                   <td>' + format(round1000(summ)) + ' сум</td>\n' +
            '               </tr>\n' +
            '               <tr>\n' +
            '                   <th scope="row">3</th>\n' +
            '                   <td>Classic</td>\n' +
            '                   <td>3% / ' + classic['bonus'] + ' сум</td>\n' +
            '                   <td><!--15% /--> ' + classic['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + classic['month'] + ' сум</td>\n' +
            '                   <td>' + format(round1000(summ)) + ' сум</td>\n' +
            '               </tr>\n' +
            '               <tr>\n' +
            '                   <th scope="row">4</th>\n' +
            '                   <td>Silver</td>\n' +
            '                   <td>7% / ' + silver['bonus'] + ' сум</td>\n' +
            '                   <td><!--10% / -->' + silver['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + silver['month'] + ' сум</td>\n' +
            '                   <td>' + format(round1000(summ)) + ' сум</td>\n' +
            '               </tr>\n' +
            '               <tr>\n' +
            '                   <th scope="row">5</th>\n' +
            '                   <td>Gold</td>\n' +
            '                   <td>10% / ' + gold['bonus'] + ' сум</td>\n' +
            '                   <td><!--5% /--> ' + gold['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + gold['month'] + ' сум</td>\n' +
            '                   <td>' + format(round1000(summ)) + ' сум</td>\n' +
            '               </tr>\n' +
            '               <tr>\n' +
            '                   <th scope="row">6</th>\n' +
            '                   <td>Platinum</td>\n' +
            '                   <td>12% / ' + platinum['bonus'] + ' сум</td>\n' +
            '                   <td><!--0% /--> ' + platinum['prepay'] + ' сум</td>\n' +
            '                   <td>12</td>\n' +
            '                   <td>' + platinum['month'] + ' сум</td>\n' +
            '                   <td>' + format(round1000(summ)) + ' сум</td>\n' +
            '               </tr>\n' +
            '           </tbody>\n' +
            '       </table>';
        return result;
    }

    function getData(summ, debt, percent, bonus, type) {

        var firstPayment, monthPayment;

        var limit = {
            'start': 7000000,
            'member': 10000000,
            'classic': 15000000,
            'silver': 22000000,
            'gold': 35000000,
            'platinum': 50000000,
        }

        var limitFree = Number(limit[type]) - Number(debt); // лимит свободный
        var q = Number(summ) - (Number(summ) * percent) / 100;

        if (q > limitFree) {
            firstPayment = Number(summ) - limitFree;
            monthPayment = limitFree / 12;
        } else {
            firstPayment = (Number(summ) * percent) / 100;
            monthPayment = q / 12;
        }

        var totalPayment = Number(summ) - Number(firstPayment); // общая сумма оплаты платеж
        var bonus = Number(summ) / 100 * bonus; // сумма бонуса

        var totalPayment = format(round1000(totalPayment));
        var firstPayment = format(round1000(firstPayment));
        var month = format(round1000(monthPayment));

        if (Number(debt) > Number(limit[type])) {
            console.log(Number(debt) + ' ' + Number(limit[type]))
            totalPayment = firstPayment = month = 'Превышен лимит карты';
        }

        return {
            'month': month,
            'total': totalPayment,
            'prepay': firstPayment,
            'bonus': format(round100(bonus)),
        }
    }

    function getMonthPayment(summ, limit, prepay) {

        if (Number(summ) <= Number(limit)) {
            monthPayment = (Number(summ) - Number(prepay)) / 12;
        } else {
            monthPayment = Number(limit) / 12;
        }

        return monthPayment;
    }

    function getFirstPayment(summ, limit, percent) {

        if (Number(summ) <= Number(limit)) {
            firstPayment = (Number(summ) / 100 * percent);
        } else {
            firstPayment = (Number(summ) - Number(limit));
        }

        return firstPayment;
    }

    function verifiedUnired() {

        $('#summ, #summ_r').attr('style', '');
        var summ = $('#summ').val();
        var summ_r = $('#summ_r').val();

        summ = summ.replace(/\s/g, '');
        summ_r = summ_r.replace(/\s/g, '');

        if (Number(summ) < 1) {
            $('#summ').attr('style', 'border: 1px solid red')
            return {
                'status': 'false'
            };
        }

        return {
            'summ': summ,
            'summ_r': summ_r,
            'status': true
        };
    }

    function verifiedTrendy() {

        $('#summTrendy').attr('style', '');
        var summ = $('#summTrendy').val();
        var debt = $('#summDebt').val();

        summ = summ.replace(/\s/g, '');
        debt = debt.replace(/\s/g, '');

        if (Number(summ) < 1) {
            $('#summTrendy').attr('style', 'border: 1px solid red')
            return {
                'status': 'false'
            };
        }

        return {
            'summ': summ,
            'debt': debt,
            'status': true
        };
    }

    function round1000(val) {
        return Math.ceil(val / 1000) * 1000;
    }

    function round100(val) {
        return Math.ceil(val / 100) * 100;
    }

    function format(number) {
        return new Intl.NumberFormat('ru-RU').format(number)
    }

    /*end*/


    /*Triggers*/

    $(document).on('keyup', '.table-unired input[name="summ_r"]', function (e) {

        let summ = $('.table-unired').find('input[name="summ"]').val();
        let summ_r = $('.table-unired').find('input[name="summ_r"]').val();

        // alert(summ);
        // alert(summ_r);

        let result = calc(Number(summ), Number(summ_r));
        $('#totalSumm').empty().html(result['unired']);
    })


    $(document).on('keyup', '.table-zmarket input[name="summ_r"]', function (e) {

        let summ = $('.table-zmarket').find('input[name="summ"]').val();
        let summ_r = $('.table-zmarket').find('input[name="summ_r"]').val();

        // alert(summ);
        // alert(summ_r);

        let result = calc(Number(summ), Number(summ_r));
        $('#totalSummZmarket').empty().html(result['zmarket']);
    })

    $(document).on('keyup', '.table-trendy input[name="summDebt"]', function (e) {

        let summ = $('.table-trendy').find('input[name="summTrendy"]').val();
        let summ_r = $('.table-trendy').find('input[name="summDebt"]').val();

        // alert(summ);
        // alert(summ_r);

        var result = calcTrandy(Number(summ), Number(summ_r));

        $('#totalSummTrendy').empty().html(result);
    })



    /*Triggers end*/


    $(document).on('click', '.forma input', function (e) {

        let type = $(this).attr('data-type');
        // let loans = document.querySelectorAll('.loan-table');

        document.querySelectorAll('.loan-table').forEach(el => el.classList.add('d-none'));

        // console.log(loans);

        $('.loan-table').addClass('d-nome');

        // alert(type);

        if (type == "trendy") {
            $('.table-trendy').removeClass('d-none');

            let summ = $('.table-trendy').find('input[name="summTrendy"]').val();
            let summ_r = $('.table-trendy').find('input[name="summDebt"]').val();

            var result = calcTrandy(Number(summ), Number(summ_r));

            $('#totalSummTrendy').empty().html(result);
            $('#totalSumm').empty()
            $('#totalSummZmarket').empty()

        }

        if (type == "unired") {

            let summ = $('.table-unired').find('.summ').val();
            let summ_r = $('.table-unired').find('.summ_r').val();

            // alert(summ);
            // alert(summ_r);

            let result = calc(Number(summ), Number(summ_r));
            $('#totalSumm').empty().html(result['unired']);
            $('#totalSummZmarket').empty()
            $('#totalSummTrendy').empty()
            $('.table-unired').removeClass('d-none');
        }

        if (type == "zmarket") {
            $('.table-zmarket').removeClass('d-none');

            let summ = $('.table-zmarket').find('.summ').val();
            let summ_r = $('.table-zmarket').find('.summ_r').val();

            // alert(summ);
            // alert(summ_r);

            let result = calc(Number(summ), Number(summ_r));
            $('#totalSumm').empty()
            $('#totalSummTrendy').empty()
            $('#totalSummZmarket').empty().html(result['zmarket']);

        }

    })


})