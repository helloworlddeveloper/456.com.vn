<!-- BEGIN: main -->
<div class="nv-fullbg">
    <form method="post" action="{ACTION_FILE}" onsubmit="return nv_validForm(this);" novalidate>
		<!-- BEGIN: cats -->
		<div class="form-group" style="display:none">
			<div class="input-group">
				<span class="input-group-addon">
					<em class="fa fa-folder-open fa-lg fa-horizon">
					</em>
				</span>
				<select class="form-control" name="fcat">
					<!-- BEGIN: select_option_loop -->
					<option value="{SELECTVALUE}">
						{SELECTNAME}
					</option>
					<!-- END: select_option_loop -->
				</select>
			</div>
		</div>
		<!-- END: cats -->
		<div class="form-group" style="display:none">
			<div class="input-group">
				<span class="input-group-addon">
					<em class="fa fa-file-text fa-lg fa-horizon">
					</em>
				</span>
				<input type="text" maxlength="255" class="form-control required" value="{CONTENT.ftitle}- Thông tin liên hệ" name="ftitle" placeholder="{LANG.title}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_title}" />
			</div>
		</div>
		<div class="row">
			<!-- BEGIN: iguest -->
			<div class="col-md-8">
				<div class="form-group">
						<input type="text" maxlength="100" value="" name="fname" class="form-control required" placeholder="{LANG.fullname}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_fullname}" />
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					
						<input type="email" maxlength="60" value="" name="femail" class="form-control required" placeholder="{LANG.email}" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_email}" />
					
				</div>
			</div>
			<!-- END: iguest -->
			<!-- BEGIN: iuser -->
			<div class="col-md-8">
				<div class="form-group">
					
						<input type="text" maxlength="100" value="{CONTENT.fname}" name="fname" class="form-control required disabled" disabled="disabled" placeholder="{LANG.fullname}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_fullname}" />
					
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<input type="email" maxlength="60" value="{CONTENT.femail}" name="femail" class="form-control required disabled" disabled="disabled" placeholder="{LANG.email}" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_email}" />
				</div>
			</div>
			<!-- END: iuser -->
			<div class="col-md-8">
				<div class="form-group">
					<input type="text" maxlength="60" value="{CONTENT.fphone}" name="fphone" class="form-control" placeholder="{LANG.phone}" />
				</div>
			</div>
		</div>	
			<div class="form-group" style="display:none">
				<div class="input-group">
					<span class="input-group-addon">
						<em class="fa fa-home fa-lg fa-horizon"></em>
					</span>
					<input type="text" maxlength="60" value="{CONTENT.faddress}" name="faddress" class="form-control" placeholder="{LANG.address}" />
				</div>
			</div>
		<div class="form-group">
            <div>
    			<textarea  cols="8" name="fcon" class="form-control required" maxlength="1000" placeholder="{LANG.content}" onkeypress="nv_validErrorHidden(this);" data-mess="{LANG.error_content}"></textarea>
            </div>
		</div>
        <div class="form-group" style="display:none">
            <label><input type="checkbox" name="sendcopy" value="1" checked="checked" /><span>{LANG.sendcopy}</span></label>
        </div>
		<div class="text-center form-group">
			<input type="hidden" name="checkss" value="{CHECKSS}" />
			<input type="submit" value="{LANG.sendcontact}" name="btsend" class="btn btn-contact" />
		</div>
	</form>
    <div class="contact-result alert"></div>
</div>
<!-- END: main -->