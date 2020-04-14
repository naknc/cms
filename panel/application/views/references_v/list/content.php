<div class="row">
<div class="col-md-12">
				<h4 class="m-b-lg">
					Referans Listesi
				<a href="<?php echo "references/new_form"; ?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
				</h4>
			</div><!-- END column -->
<div class="col-md-12">
				<div class="widget p-lg">

					<?php if(empty ($items)) { ?>

				<div class="alert alert-info text-center">
					<p>Burada herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo "references/new_form"; ?>">tıklayınız</a></p>
				</div>

				<?php } else { ?>

					<table class="table table-hover table-striped table-bordered content-container">
						<thead>
							<th class="order w50"><i class="fa fa-reorder"></i></th>
							<th class="w50">#id</th>
							<th>Başlık</th>
							<th>url</th>
							<th>Görsel</th>
							<th>Durumu</th>
							<th>İşlem</th>
						</thead>
						<tbody class="sortable" data-url="<?php echo base_url("references/rankSetter"); ?>">

							<?php foreach($items as $item) { ?>
							<tr id="ord-<?php echo $item->id; ?>">
								<td class="order"><i class="fa fa-reorder"></i></td>
								<td class="w50 text-center"><?php echo $item->id; ?></td>
								<td><?php echo $item->title; ?></td>
								<td><?php echo $item->url; ?></td>
								<!--<td><?php echo $item->description; ?></td>-->
								<td>
										<img width="75" 
										src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" 
											alt="" class="img_rounded">
								</td>
								<td>
									<input
										data-url="<?php echo base_url("references/isActiveSetter/$item->id")?>"
										class="isActive"
										type="checkbox" 
										data-switchery 
										data-color="#10c469" 
										<?php echo ($item->isActive) ? "checked" : ""; ?>
									/>
								</td>
								<td>
									<button 
										data-url="<?php echo "references/delete/$item->id"; ?>" 
										class="btn btn-sm btn-danger btn-outline remove-btn">
										<i class="fa fa-trash"></i> Sil
									</button>
									<a href="<?php echo "references/update_form/$item->id"; ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
								</td>
							</tr>

							<?php } ?>

						</tbody>

					</table>

				<?php } ?>

				</div><!-- .widget -->
			</div>
</div>