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
        <input type="hidden" id="receiverId" value="{{  $receiverId }}">
        <input type="hidden" id="receivername" value="{{  $otname }}">
        
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
            let receiverId = $('#receiverId').val();
            let message = $('#messageContent').val().trim();
            let listofmessages = $('#messages');
            console.log(message);

            $.ajax({
                url: '/messages/send', 
                method: 'POST',
                data: {
                    sender_id: senderId,
                    receiver_id: receiverId,
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


        let senderId = $('#senderId').val();
        let receiverId = $('#receiverId').val();
        var Channelname = "messages."+  String(receiverId)+"." + String(senderId);
        console.log(Channelname);



        console.log(Echo);
        Echo.private(Channelname)
            .listen('MessageSentEvent', (event) => {
                console.log(event);
                let receivername = $('#receivername').val();
                var newmessageapp =   '<p><strong>'+ receivername  + ' :</strong> ' + event.message +'</p>';
                $('#messages').append(newmessageapp);
            }).on('pusher:subscription_succeeded', () => {
        console.log("Subscription successful!");
    })
    .on('pusher:subscription_error', (status) => {
        console.error("Subscription error:", status);
    });
    });
</script>




@endsection