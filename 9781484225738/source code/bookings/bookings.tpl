<div id="product-bookings" class="panel product-tab">
	<input type="hidden" name="submitted_tabs[]" value="Bookings" />
	<h3 class="tab"> <i class="icon-info"></i> {l s='Booking'}</h3>
	
	<div class="form-group">
   		<label class="control-label col-lg-3" for="booking_dates">
      			<span class="label-tooltip" data-toggle="tooltip"
      			  title="{l s='Booking Dates'}">
         		  {l s='Booking Dates'}
      			</span>
   		</label>
   		<div class="col-lg-5">
      		     <input type="text" id="booking_dates" name="booking_dates" value="{$bookings|htmlentitiesUTF8}"/>
   		</div>
	</div>

	<div class="panel-footer">
		<a href="{$link->getAdminLink('AdminProducts')|escape:'html':'UTF-8'}{if isset($smarty.request.page) && $smarty.request.page > 1}&amp;submitFilterproduct={$smarty.request.page|intval}{/if}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel'}</a>
		<button type="submit" name="submitAddproduct" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> {l s='Save'}</button>
		<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> {l s='Save and stay'}</button>
	</div>
</div>

