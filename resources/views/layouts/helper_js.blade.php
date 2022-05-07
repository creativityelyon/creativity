<script>
function convertToMoney(val){
    return val.toLocaleString('de-DE');
}

function getMoneyValue(val){
    val = val.replace(/\./g, "");
    return parseInt(val) || 0;
}

function convertToDecimal(val){
  return numeral(val).format('0,0.00') || 0;
}

function getMoneyDecimalValue(val)
{
  val = val.replace(/\,/g,"");
  return numeral(val).format('0,0.00') || 0;
}

function goDate(val)
{
  var from = val.split("/");
  var f = new Date(from[2], from[1] - 1, from[0]);
  return formatDate(new Date(f));
}

function initMoneyFormat(){
    $('.money').each(function(){
        $(this).val(convertToMoney(getMoneyValue($(this).val())));
        $(this).addClass('align-right')
    });
    $('.money').change(function(){
        $(this).val(convertToMoney(getMoneyValue($(this).val())));
    });
}

function formatDate(val){
    return ('0' + val.getDate()).slice(-2) + '/' + ('0' + (val.getMonth()+1)).slice(-2) + '/' + val.getFullYear();
};

function formatDateStripes(val){
    return ('0' + val.getDate()).slice(-2) + '-' + ('0' + (val.getMonth()+1)).slice(-2) + '-' + val.getFullYear();
};
function initMoneyDecimalFormat() {
  $('.money_decimal').each(function(){
    $(this).val(getMoneyDecimalValue(getMoneyDecimalValue($(this).val())));
    $(this).addClass('align-right')
  });
  $('.money_decimal').change(function(){
    $(this).val(getMoneyDecimalValue(getMoneyDecimalValue($(this).val())));
  });
}

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function isNumberKey(evt)
{
  if (evt.which != 46 && evt.which != 45 && evt.which != 46 &&
      !(evt.which >= 48 && evt.which <= 57)) {
    return false;
  }
}

function initDatePickerInput(object)
{
  $(object).datepicker({
    format: "dd/mm/yyyy",
    autoclose: true
  });
}

$('form').off('keypress.disableAutoSubmitOnEnter').on('keypress.disableAutoSubmitOnEnter', function(event) {
    if (event.which === event.keyCode.ENTER && $(event.target).is(':input:not(textarea,:button,:submit,:reset)')) {
        event.preventDefault();
    }
});

</script>
