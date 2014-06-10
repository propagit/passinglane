<span class="footer-title">Contact - </span><span class="footer-subtitle">Our Support Team</span>
<form id="contact-form">
<div class="custom-form-wrap push no-padding">
    <div class="form-group">
        <span class="col-sm-10 remove-left-gutter mandatory-label">* Denotes required field</span>
    </div>
    <div class="form-group" id="f_name">
        <label class="col-sm-4 remove-left-gutter control-label">Your Name *</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" placeholder="Your Name" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 remove-left-gutter control-label">Your Phone</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="phone" placeholder="Your Phone" />
        </div>
    </div>
    <div class="form-group" id="f_email">
        <label class="col-sm-4 remove-left-gutter control-label">Your Email *</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="email" placeholder="Your Email" />
        </div>
    </div>
    <div class="form-group" id="f_message">
        <label class="col-sm-4 remove-left-gutter control-label">Message *</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="message" rows="6"></textarea>
        </div>
    </div>
    <div class="pull-right">
        <span class="text-success" id="send-result"></span>
        <button id="btn-contact" type="button" class="btn btn-primary right10"><i class="fa fa-envelope-o right5"></i> SEND</button>
    </div>
</div>
</form>
<script>
$j(function(){
    $j('#btn-contact').click(function(){
        $j('#contact-form').find('.form-group').removeClass('has-error');
        $j.ajax({
            type: "POST",
            url: "<?=base_url();?>pages/ajax/submit_contact_form",
            data: $j('#contact-form').serialize(),
            success: function(data) {
                data = $j.parseJSON(data);
                if (!data.ok) {
                    $j('#f_' + data.error_id).addClass('has-error');
                    $j('input[name="' + data.error_id + '"]').focus();
                } else {
                    $j('#send-result').html('Your message has been sent successfully! &nbsp; &nbsp;');
                    $j('#contact-form')[0].reset();
                }
            }
        })
    })
})
</script>
