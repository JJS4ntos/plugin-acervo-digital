<script type="text/javascript">
  $(document).ready(function() {
    $('#page').change(function(){
      $('#page_url').val($(this).val());
      $('#pagination').submit();
    });
  });
</script>

<form id="pagination">
  <input type="hidden" name="r" value="10">
  <input type="hidden" name="l" id="page_url">
</form>

<select class="form-control" id="page">
  @for( $i=1; $i < $pages; $i++ )
    <option value="{{ $i }}">Página {{ $i }}</option>
  @endfor
</select>
