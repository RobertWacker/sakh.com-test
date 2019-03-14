
<div class="page" style="display: flex;">
	<article style="width: 70%; padding-right: 15px;">
		<div class="balance__block">Ваш баланс: <?php echo $data['balance']; ?></div>
		Совершить перевод<br>
		<form method="POST" action="/wallet">
			<div class="transfer">
				<div class="transfer__label">$</div>
				<input type="number" name="transfer">
			</div><br>
				получатель:<br>
			<select name="recipient">
				<?php
					foreach ($data['contacts'] as $key => $value) {
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
				?>
			</select>
			<button type="submit">Отправить</button>
		</form>


	<div class="table">
		<div class="table__header">
			<div class="table__cell" style="width: 50px;"><a href="#">id</a></div>
			<div class="table__cell"><a href="#">Имя</a></div>
			<div class="table__cell"><a href="#">Баланс</a></div>
		</div><!-- /table__header -->


		<?php foreach ($data['rows'] as $mas => $line) { ?>

			<div id="row<?php echo $line['id']; ?>" class="table__row">
				<div class="table__cell"><?php echo $line['id']; ?></div>
				<div class="table__cell">
					<i class="far fa-address-card"></i>
					<a href="#<?php echo $line['name']; ?>" class="login">
						<?php echo $line['name']; ?>
					</a>
				</div>
				<div class="table__cell"><?php echo $line['balance']; ?></div>

			</div><!-- /table__row -->

		<?php } ?>

	</div><!-- /table -->

	</article>
	<aside style="width: 30%;">

		<div class="log">
			<div class="log__header">История переводов</div>
			<div class="log__content">

				<?php 

					$id = 1;
					foreach ($data['log'] as $key => $value) {

						if($value['sender_id'] != $id) {

							echo '<div class="log__plus">
									<span class="log__int">+'.$value['amount'].'</span>
								</div>';
						} else {
							echo '<div class="log__minus">
									<span class="log__int">-'.$value['amount'].'</span>
								</div>';
						}
					}

				?>
			</div>
		</div>

		<a href="/wallet?add=1000">Добавить 1000 УЕ</a>
	</aside>

</div><!-- /page -->