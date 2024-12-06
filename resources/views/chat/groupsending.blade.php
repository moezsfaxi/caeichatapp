@extends('layouts.app')

@section('content')
<div id="conversation">
    <div id="messages">
        <!-- Display existing messages here -->
        @foreach ($messages as $message)
           
            <p><strong>{{ $message->sender->name }}:</strong> {{ $message->message }}</p>
        @endforeach
    </div>

    <!-- Message sending form -->
    <form id="messageForm">
        <input type="hidden" id="senderId" value="{{ auth()->id() }}">
        <input type="hidden" id="groupId" value="{{  $groupId }}">
      
        
        <div>
            <input type="text" id="messageContent" placeholder="Type your message..." required>
        </div>
        <button type="submit">Send</button>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<!-- <script src="{{ asset('js/app.js') }}"></script>  -->
@vite('resources/js/app.js')

<script>
    $(document).ready(function() {
        
        $('#messageForm').on('submit', function(e) {
            e.preventDefault();

            let senderId = $('#senderId').val();
            let groupId = $('#groupId').val();
            let message = $('#messageContent').val().trim();
            let listofmessages = $('#messages');
            console.log(message);

            $.ajax({
                url: '/groupmessages/send', 
                method: 'POST',
                data: {
                    sender_id: senderId,
                    group_id: groupId,
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    
                    var newmessageapp =   '<p><strong>'+ '{{ Auth::user()->name }}' + ' :</strong> '+ message +'</p>';
                  
                    listofmessages.append(newmessageapp);

                    
                    $('#messageContent').val('');
                },
                error: function(xhr) {
                    console.error("Error sending message:", xhr.responseText);
                }
            });
        });
        
        let groupId = $('#groupId').val();
        var Channelname = "group."+  String(groupId);
        console.log(Channelname);




        console.log(Echo);
        Echo.private(Channelname)
            .listen('GroupMessageSentEvent', (event) => {
                console.log(event);
                
                var newmessageapp =   '<p><strong>'+ event.sender_name  + ' :</strong> ' + event.message +'</p>';
                $('#messages').append(newmessageapp);
            }).on('pusher:subscription_succeeded', () => {
        console.log("Subscription successful!");
    })
    .on('pusher:subscription_error', (status) => {
        console.error("Subscription error:", status);
    })   ;
    });
</script>




@endsection