<?phpuse yii\helpers\Html;use backend\models\Contact;use soft\helpers\SUrl;Yii::$app->name = t('Texnomart')?><header class="main-header">	<?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo', 'id' => 'admin-url']) ?>	<nav class="navbar navbar-static-top" role="navigation">		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">			<span class="sr-only">Toggle navigation</span>		</a>        <div class="navbar-custom-menu">			<ul class="nav navbar-nav">				<li class="dropdown user user-menu">					<a href="#" class="dropdown-toggle" data-toggle="dropdown">						<span class="hidden-xs"><?= Yii::$app->user->isGuest ? '' : fa('user')." ".Yii::$app->user->identity->username?></span>					</a>					<ul class="dropdown-menu">						<!-- User image -->						<li class="user-header">                            <?= Html::img(Yii::$app->user->identity->image, ['class' => 'img-circle','style'=>[//                                'width'=>'50px'                            ]]) ?>							<p>								<?= Yii::$app->user->isGuest ? '' :  Yii::$app->user->identity->username?>								<small><?= Yii::$app->user->isGuest ? '' :  Yii::$app->user->identity->email?></small>							</p>						</li>						<!-- Menu Body -->						<!-- Menu Footer-->						<li class="user-footer">							<div class="pull-left">								<?= a(Yii::t('app', "Profile"), ['/profilemanager'], ['class'=>"btn btn-default btn-flat"], 'wrench') ?>							</div>							<div class="pull-right">								<?= Html::beginForm(['/site/logout'], 'post')								. Html::submitButton(									fa('sign-out')." ". Yii::t('app', "Logout"),									['class' => 'btn btn-default btn-flat']								)								. Html::endForm()								?>							</div>						</li>					</ul>				</li>            </ul>        </div>    </nav></header>