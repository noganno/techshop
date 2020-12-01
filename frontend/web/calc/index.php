<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="./css/bootstrap.min.css"/>
<link rel="stylesheet" href="./css/style.css"/>
<!--<linl href="">-->
    <script src="./js/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous">
	</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
    <script src="./js/common.js"></script>
	
    <div class="container">
        <div class="row">
            <div class="for-image col-md-6">
                <i class="fa fa-backspace"></i>
                <a type=button href="https://texnomart.uz/" class="home_page">Главная страница</a>
            </div>
            <div class="for-image col-md-6" style="text-align:end;">
                <img src="upload/internet-magazin.png" alt="texnomart*" />
            </div> 
        </div>
       
        <div class="row mt-4">
            <div class="col align-self-center">
				<h3>Unired / Z Market</h3>
				<hr>
                <div class="form-row">    
                    <div class="form-group col-md-12 row">
                        <div class="col-md-6">
                            <label for="summ">Сумма полной оплаты</label>
                            <input type="text" class="form-control summ" id="summ" name="summ"
                                   aria-describedby="emailHelp"
                                   placeholder="Введите сумму полной оплаты товара" />
                            <small id="emailHelp" class="form-text text-muted">Введите сумму полной оплаты товара</small>
                        </div>
                        <div class="col-md-6">
                            <label for="summ">Лимит / Баланс карты Unired</label>
                            <input type="text" class="form-control summ" id="summ_r" name="summ"
                                   aria-describedby="emailHelp"
                                   placeholder="Введите лимит карты Unired" />
                            <small id="emailHelp" class="form-text text-muted">Введите лимит карты Unired</small>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mb-2">
						<div class="for-button col-md-12">
							<button id="submitForm" class="btn btn-success">Рассчитать</button>
							<button id="refreshForm" class="btn btn-danger">Очистить</button>
						</div>

						
                        <div class="table-responsive table-unired">
							<div class="for-image">
								<img src="upload/Unired.png" alt="UNIRED" />
							</div>
                            <h2 class="headings"
                                
							>
                                Тарифы <span class="unlogo">UNIRED</span>
							</h2>
                            <table class="table table-bordered table-hover">
                                <thead class="unired-static">
                                <tr class="table-main">
                                    <th>Размер заработной платы, выдаваемой на пластиковую карту</th>
                                    <th>Первоначальный лимит</th>
                                    <th>Максимальный лимит</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1&nbsp;200&nbsp;000</td>
                                    <td>3&nbsp;000&nbsp;000</td>
                                    <td>9&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>1&nbsp;500&nbsp;000</td>
                                    <td>4&nbsp;500&nbsp;000</td>
                                    <td>10&nbsp;500&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>2&nbsp;000&nbsp;000</td>
                                    <td>6&nbsp;000&nbsp;000</td>
                                    <td>12&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>3&nbsp;000&nbsp;000</td>
                                    <td>9&nbsp;000&nbsp;000</td>
                                    <td>15&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>4&nbsp;000&nbsp;000</td>
                                    <td>12&nbsp;000&nbsp;000</td>
                                    <td>18&nbsp;000&nbsp;000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="totalSumm"></div>

						
                        <div class="table-responsive table-unired">
							<div class="for-image">
								<img src="upload/ZMarket.png" alt="Z Market" />
							</div>
                            <h2 class="headings"
							
							>
                                Тарифы <span class="unlogo">Z Market</span>
							</h2>
                            <table class="table table-bordered table-hover">
                                <thead class="zmarket-static">
                                <tr class="table-main">
                                    <th>Размер заработной платы, выдаваемой на пластиковую карту</th>
                                    <th>Максимальный лимит</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>800&nbsp;000</td>
                                    <td>1&nbsp;500&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>1&nbsp;000&nbsp;000</td>
                                    <td>3&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>2&nbsp;000&nbsp;000</td>
                                    <td>5&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>3&nbsp;000&nbsp;000</td>
                                    <td>8&nbsp;000&nbsp;000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        
						<div id="totalSummZmarket"></div>
						
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col align-self-center">
                <h3>Trendy Trade</h3>
				<hr>
                <div class="form-row">
					<div class="form-group col-md-12 row">
						<div class="col-md-6">
							<label for="summ">Сумма рассрочки</label>
							<input type="text" class="form-control summ" id="summTrendy" name="summTrendy"
								aria-describedby="emailHelp"
								placeholder="Введите сумму рассрочки" />
							<small class="form-text text-muted">Введите сумму рассрочки</small>
						</div>
						<div class="col-md-6">
							<label for="summ">Задолженность</label>
							<input type="text" class="form-control summ" id="summDebt" name="summDebt"
								aria-describedby="emailHelp"
								placeholder="Введите сумму задолженности" />
							<small class="form-text text-muted">Введите сумму задолженности</small>
						</div>
					</div>
                    <div class="form-group col-md-12 mb-2">
						<div class="for-button col-md-12">
							<button id="submitFormTrendy" class="btn btn-success">Рассчитать</button>
							<button id="refreshFormTrendy" class="btn btn-danger">Очистить</button>
						</div>	
                        
						
						<div class="table-responsive table-trendy">
							<div class="for-image">
								<img src="upload/internet-magazin.png" alt="Trendy Trade" />
							</div>
                            <h2 class="headings"
                                
							>
                                Бонусные карты <span class="unlogo">Trendy Trade</span>
							</h2>
                            <table class="table table-bordered table-hover">
                                <thead class="trendy-static">
                                <tr class="table-main">
                                    <th>Типы бонусных карт</th>
                                    <th>Сумма апгрейда</th>
                                    <th>Максимальный лимит</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Start</td>
                                    <td>&nbsp;0&nbsp;</td>
                                    <td>7&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>Member</td>
                                    <td>1&nbsp;300&nbsp;000</td>
                                    <td>10&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>Classic</td>
                                    <td>3&nbsp;500&nbsp;000</td>
                                    <td>15&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>Silver</td>
                                    <td>10&nbsp;000&nbsp;000</td>
                                    <td>22&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>Gold</td>
                                    <td>30&nbsp;000&nbsp;000</td>
                                    <td>35&nbsp;000&nbsp;000</td>
                                </tr>
                                <tr>
                                    <td>Platinum</td>
                                    <td>50&nbsp;000&nbsp;000</td>
                                    <td>50&nbsp;000&nbsp;000</td>
                                </tr>								
                                </tbody>
                            </table>
                        </div>

                        <div id="totalSummTrendy"></div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>


