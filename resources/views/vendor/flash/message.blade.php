@foreach (session('flash_notification', collect())->toArray() as $message)
<script>
    toastr["{{ $message['level'] }}"](
       "{{ $message['message']}}",
      {
        closeButton: false,
        tapToDismiss: false,
        progressBar: true,
      })
</script>
@endforeach
{{ session()->forget('flash_notification') }}
