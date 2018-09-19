<?php

use yii\helpers\Url;

use frontend\models\Language;

$language = new Language();

$code = Yii::$app->language;

$languages = $language->getLanguages();
$lang = $language->getLanguageByCode($code);

?>

<a href="#" class="dropdown-toggle language-use" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	<span class="flag flag-name flag-<?= $lang['locale'] ?>"></span>
	<span class="caption"><?= $lang['name'] ?></span>
	
	<span class="caret"></span>
</a>

<ul class="dropdown-menu" aria-labelledby="drop1">
	<li>
		<?php foreach($languages as $item) { ?>
		<?php if($item['code'] == $code) continue; ?>
		<a href="<?= Url::to(array_merge(\Yii::$app->request->get(), [\Yii::$app->controller->route, 'language' => $item['locale']])) ?>">
			<span class="flag flag-name flag-<?= $item['locale'] ?>"></span>
			<span class="caption"><?= $item['name'] ?></span>
		</a>
		<?php } ?>
	</li>
</ul>