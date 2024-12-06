@extends('layouts.app')


@section('content')
<section style="background-color: #CDC4F9;" >
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="chat3" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                    <div class="p-3">

                                        <!-- creating the button  -->
                                        
                                        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#userListModal">
                                        créer un groupe de chat
                                        </button>
                                        <!-- Tabs for Contacts and Groups -->
                                        <ul class="nav nav-tabs mb-3" id="chatTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="true">
                                                    Contacts
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#groups" type="button" role="tab" aria-controls="groups" aria-selected="false">
                                                    Groups
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="chatTabsContent" >
                                            <!-- Contacts Tab -->
                                            <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                                                <div data-mdb-perfect-scrollbar-init class="overflow-auto" style="position: relative; height: 350px">
                                                    <ul class="list-unstyled mb-0">

                                                    @foreach($users as $user )
                                                    <li class="p-2 border-bottom contact-item" data-receiver-id="{{$user->id}}" data-cuser-id="{{ auth()->id() }}"  >
                                                            <a href="#!" class="d-flex justify-content-between ">
                                                                <div class="d-flex flex-row">
                                                                    <div>
                                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                                      
                                                                        <span class="badge  rounded-circle badge-dot"  style="width: 20px; height: 20px;" ></span>

                                                                    
                                                                    </div>
                                                                    <div class="pt-1">
                                                                        <p class="fw-bold mb-0">{{ $user->name  }}
                                                                        </p>
                                                                        <p class="small text-muted">Hello, Are you there?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-1">
                                                                    <p class="small text-muted mb-1">Just now</p>
                                                                    <span class="badge bg-danger rounded-pill float-end">3</span>
                                                                </div>
                                                            </a>
                                                        </li>



                                                    @endforeach
                                                        <!-- More contact list items as in the original -->
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Groups Tab -->
                                            <div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                                                <div data-mdb-perfect-scrollbar-init class="overflow-auto" style="position: relative; height: 350px">
                                                    <ul class="list-unstyled mb-0">


                                                    @foreach($groups as $group )
                                                    <li class="p-2 border-bottom group-item"  data-group-id="{{$group->id}}" data-cuser-id="{{ auth()->id() }}"   >
                                                            <a href="#!" class="d-flex justify-content-between">
                                                                <div class="d-flex flex-row">
                                                                    <div>
                                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                                        <span class="badge bg-success rounded-circle badge-dot"  style="width: 20px; height: 20px;"></span>
                                                                    </div>
                                                                    <div class="pt-1">
                                                                        <p class="fw-bold mb-0">{{$group->name}} </p>
                                                                        <p class="small text-muted"> {{ $group->users_count }}  members</p>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-1">
                                                                    <p class="small text-muted mb-1">Last active</p>
                                                                    <span class="badge bg-danger rounded-pill float-end">2</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chat Message Area -->
                                <div class="col-md-6 col-lg-7 col-xl-8">
                                    <div class="pt-3 pe-3 overflow-auto" data-mdb-perfect-scrollbar-init style="position: relative; height: 400px" id="chatbox">
                                        <!-- Chat Messages -->
                                    </div>

                                    <form id="messageForm" data-case-based=""  class="d-flex align-items-center pe-3 pt-3 mt-2" data-myuser-name="{{ $myname }}"  data-groupuser-id="{{ auth()->id() }}"  data-current-group="" data-dm-send="" data-dm-receive="" >
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"  alt="avatar" style="width: 40px; height: 40px; border-radius: 50%;">



                                     <input type="text" class="form-control form-control-lg ms-3" id="messageContent" placeholder="Type your message..." required>

                                    <button type="submit" class="btn ms-3">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!-- adding the modal -->                 
<!-- Modal -->
<div class="modal fade" id="userListModal" tabindex="-1" role="dialog" aria-labelledby="userListModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userListModalLabel">Select Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- List of Users with checkboxes -->
        <form action="{{ route('createagroupchat') }}" method="POST">
          @csrf
          <div class="form-group row"> 
            <label for="groupname" class="col-md-4 col-form-label"  >group name :</label>
            <div class="col-sm-10"> 
              <input type="text" id="groupname"  name="groupname" class="form-control"  required>

            </div>

          </div>
          <div class="form-check">
            @foreach($users as $user)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="selected_users[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                <label class="form-check-label" for="user{{ $user->id }}">
                  {{ $user->name }}
                </label>
              </div>
            @endforeach
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">create a group chat</button>
      </div>
        </form>
    </div>
  </div>
</div>
        <!-- end modal -->
                <!--  the end  -->





    </section>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
                    <!-- <script src="{{ asset('js/app.js') }}"></script>  -->
                    @vite('resources/js/app.js') 
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const contacts = document.querySelectorAll('.contact-item');
    const groups = document.querySelectorAll('.group-item');
    const messageForm = document.querySelector('#messageForm');


    const messageContent = document.querySelector('#messageContent');
    let typingTimer;
    const TYPING_TIMEOUT = 1500;
    


    const forscroll = document.querySelector('#chatbox');
    function scrollToBottom() {
        chatbox.scrollTop = chatbox.scrollHeight;
    }


    let currentChannel = null;

    
    messageContent.addEventListener('input', function() {
        
        console.log("i m typing");
        if (messageForm.dataset.caseBased === "contact") {
            console.log("the case is contact");

            const senderId = messageForm.dataset.dmSend;
            const receiverId = messageForm.dataset.dmReceive;
            const myname = document.querySelector('#messageForm').dataset.myuserName;
           
            Echo.private(`messages.${senderId}.${receiverId}`)
                .whisper('typing', {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    sender_name : myname,
                    isTyping: true
                });
                console.log("i m sending that i m typing");
          
            clearTimeout(typingTimer);
        
            typingTimer = setTimeout(() => {
                Echo.private(`messages.${senderId}.${receiverId}`)
                    .whisper('typing', {
                        sender_id: senderId,
                        receiver_id: receiverId,
                        sender_name : myname,
                        isTyping: false
                    });
            }, TYPING_TIMEOUT);
            console.log("clearing ..................");
        }
    });

   




function unsubscribeFromCurrentChannel() {
    if (currentChannel) {
        Echo.leave(currentChannel);
        currentChannel = null;
    }
}

    
    async function handleMessageSubmit(e) {
        e.preventDefault();
        const toggledmgroup = messageForm.dataset.caseBased;
        
        if (toggledmgroup === "group") {
            await handleGroupMessage(messageForm);
        } else if (toggledmgroup === "contact") {
            await handleContactMessage(messageForm);
        }
    }

   
    async function handleGroupMessage(form) {
        const senderId = form.dataset.groupuserId;
        const myname = form.dataset.myuserName;
        const groupId = form.dataset.currentGroup;
        const messageContent = document.querySelector('#messageContent');
        const message = messageContent.value.trim();
        const listofmessages = document.querySelector('#chatbox');

        try {
            const response = await fetch('/groupmessages/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    sender_id: senderId,
                    group_id: groupId,
                    message: message
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const timestamp = formatTimestamp(new Date());
            let newMessageElement = groupcreateChatMessageElementstart(
                'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                message,
                timestamp,
                myname
            );
            console.log(newMessageElement);
            listofmessages.appendChild(newMessageElement);
            scrollToBottom();
            messageContent.value = '';
        } catch (error) {
            console.error("Error sending message:", error);
        }
    }

    
    async function handleContactMessage(form) {
        const senderId = form.dataset.dmSend;
        const receiverId = form.dataset.dmReceive;
        const messageContent = document.querySelector('#messageContent');
        const message = messageContent.value.trim();
        const listofmessages = document.querySelector('#chatbox');

        try {
            const response = await fetch('/messages/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    sender_id: senderId,
                    receiver_id: receiverId,
                    message: message
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const timestamp = formatTimestamp(new Date());
            let newMessageElement = createChatMessageElementend(
                'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                message,
                timestamp
            );
            listofmessages.appendChild(newMessageElement);
            scrollToBottom();
            messageContent.value = '';
        } catch (error) {
            console.error("Error sending message:", error);
        }
    }

 
    function formatTimestamp(date) {
        const time = new Intl.DateTimeFormat('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        }).format(date);
        const dateStr = new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric'
        }).format(date);
        return `${time} | ${dateStr}`;
    }

   
    contacts.forEach(contact => {
        contact.addEventListener('click', function() {

            unsubscribeFromCurrentChannel();

            messageForm.dataset.caseBased = "contact";
            const receiverId = this.dataset.receiverId;
            const cuserId = this.dataset.cuserId;
            messageForm.dataset.dmSend = cuserId;
            messageForm.dataset.dmReceive = receiverId;

            fetch(`/fetch-messages/${receiverId}`)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.querySelector('#chatbox');
                    chatBox.innerHTML = '';
                    document.querySelector("#messageContent").value ="";
                    data.messages.forEach(message => {
                        let messageElement;
                        if (cuserId == message.sender_id) {
                            messageElement = createChatMessageElementend(
                                'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                                message.message,
                                message.created_at
                            );
                        } else {
                            messageElement = createChatMessageElementstart(
                                'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                                message.message,
                                message.created_at
                            );
                        }
                        chatBox.appendChild(messageElement);
                        scrollToBottom();
                    });
                })
                .catch(error => console.error('Error fetching messages:', error));


             
                var channelName = "messages."+  String(receiverId)+"." + String(cuserId);
                console.log(channelName);
                currentChannel = channelName; // Store current channel name
            
            Echo.private(channelName).listenForWhisper('typing', (e) => {
                    console.log( "this is the event",e);
                    
                
                    const typingIndicator = document.querySelector('#typing-indicator');
                    if (e.isTyping) {
                        if (!typingIndicator) {
                            const indicator = document.createElement('div');
                            indicator.id = 'typing-indicator';
                            indicator.classList.add('small', 'text-muted', 'ms-3', 'mb-2');
                            indicator.textContent = `${e.sender_name} is typing...`;
                            document.querySelector('#chatbox').appendChild(indicator);
                            scrollToBottom();
                        }
                    } else {
                        if (typingIndicator) {
                            typingIndicator.remove();
                        }
                    }
                }).listen('MessageSentEvent', (event) => {
                    const typingIndicator = document.querySelector('#typing-indicator');
                    if (typingIndicator) {
                        typingIndicator.remove();
                    }



                    const currentUserId = messageForm.dataset.groupuserId;
                    if (event.sender_id != currentUserId) {
                        const newMessageElement = groupcreateChatMessageElementstart(
                            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                            event.message,
                            event.created_at,
                            event.sender_name
                        );
                        document.querySelector('#chatbox').appendChild(newMessageElement);
                        scrollToBottom()
                    }
                })
                .on('pusher:subscription_succeeded', () => {
                    console.log(`Subscribed to ${channelName}`);
                })
                .on('pusher:subscription_error', (status) => {
                    console.error(`Subscription error for ${channelName}:`, status);
                });
         
                

        });
    });

    
    groups.forEach(group => {
        group.addEventListener('click', function() {
            
            unsubscribeFromCurrentChannel();
            
            messageForm.dataset.caseBased = "group";
            const groupId = this.dataset.groupId;
            const cuserId = this.dataset.cuserId;
            messageForm.dataset.currentGroup = String(groupId);

            fetch(`/fetch-messages-group/${groupId}`)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.querySelector('#chatbox');
                    chatBox.innerHTML = '';
                    document.querySelector("#messageContent").value ="";
                    data.messages.forEach(message => {
                        let messageElement = groupcreateChatMessageElementstart(
                            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                            message.message,
                            message.created_at,
                            message.sender_name
                        );
                        chatBox.appendChild(messageElement);
                        scrollToBottom();
                    });
                })
                .catch(error => console.error('Error fetching messages:', error));

          
            const channelName = `group.${groupId}`;
            currentChannel = channelName; 
            
            Echo.private(channelName)
                .listen('GroupMessageSentEvent', (event) => {
                    const currentUserId = messageForm.dataset.groupuserId;
                    if (event.sender_id != currentUserId) {
                        const newMessageElement = groupcreateChatMessageElementstart(
                            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
                            event.message,
                            event.created_at,
                            event.sender_name
                        );
                        document.querySelector('#chatbox').appendChild(newMessageElement);
                        scrollToBottom()
                    }
                })
                .on('pusher:subscription_succeeded', () => {
                    console.log(`Subscribed to ${channelName}`);
                })
                .on('pusher:subscription_error', (status) => {
                    console.error(`Subscription error for ${channelName}:`, status);
                });







        });
    });



    function updateUserStatus(userId, status) {
        const contactItems = document.querySelectorAll('.contact-item');
        console.log("inside the user status function");
        contactItems.forEach(item => {
            if (item.dataset.receiverId === userId.toString()) {
                const statusBadge = item.querySelector('.badge-dot');
                if (status) {
                    statusBadge.classList.remove('bg-danger');
                    statusBadge.classList.add('bg-success');
                } else {
                    statusBadge.classList.remove('bg-success');
                    statusBadge.classList.add('bg-danger');
                }
            }
        });
    }

    
    Echo.channel('user-status')
        .listen('UserStatusChanged', (e) => {
            console.log("the event :" ,e  );
            console.log("in the listening for user-status");
            updateUserStatus(e.user_id, e.status);
        });

    
    function sendHeartbeat() {
        if (document.visibilityState === 'visible') {
            fetch('/heartbeat', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
        }
    }

    
    setInterval(sendHeartbeat, 3 * 60 * 1000);

    
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            sendHeartbeat();
        }
    })









    
    messageForm.addEventListener('submit', handleMessageSubmit);
});
                    
                    


           





 function createChatMessageElementstart(img,textmessage,createdatfield ) {

  const chatMessageDiv = document.createElement('div');
  chatMessageDiv.classList.add('d-flex', 'flex-row', 'justify-content-start');

  const avatarImg = document.createElement('img');
  avatarImg.src = img;  
  //'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp';
  avatarImg.alt = 'avatar 1';
  avatarImg.style.width = '45px';
  avatarImg.style.height = '100%';

 
  const textDiv = document.createElement('div');


  const messageParagraph = document.createElement('p');
  messageParagraph.classList.add('small', 'p-2', 'ms-3', 'mb-1', 'rounded-3', 'bg-body-tertiary');
  messageParagraph.textContent = textmessage;


  const timestampParagraph = document.createElement('p');
  timestampParagraph.classList.add('small', 'ms-3', 'mb-3', 'rounded-3', 'text-muted', 'float-end');
  timestampParagraph.textContent = createdatfield;

 
  textDiv.appendChild(messageParagraph);
  textDiv.appendChild(timestampParagraph);
  chatMessageDiv.appendChild(avatarImg);
  chatMessageDiv.appendChild(textDiv);
  console.log(chatMessageDiv);

  return chatMessageDiv;
 }


 function createChatMessageElementend(img,textmessage,createdatfield) {
  
  const chatMessageDiv = document.createElement('div');
  chatMessageDiv.classList.add('d-flex', 'flex-row', 'justify-content-end');

  
  const textDiv = document.createElement('div');

 
  const messageParagraph = document.createElement('p');
  messageParagraph.classList.add('small', 'p-2', 'me-3', 'mb-1', 'text-white', 'rounded-3', 'bg-primary');
  messageParagraph.textContent =  textmessage;

  
  const timestampParagraph = document.createElement('p');
  timestampParagraph.classList.add('small', 'me-3', 'mb-3', 'rounded-3', 'text-muted');
  timestampParagraph.textContent = createdatfield ;

  
  textDiv.appendChild(messageParagraph);
  textDiv.appendChild(timestampParagraph);
  chatMessageDiv.appendChild(textDiv);

  
  const avatarImg = document.createElement('img');
  avatarImg.src = img;  
  avatarImg.alt = 'avatar 1';
  avatarImg.style.width = '45px';
  avatarImg.style.height = '100%';
  chatMessageDiv.appendChild(avatarImg);

  return chatMessageDiv;
 }




 function groupcreateChatMessageElementstart(img,textmessage,createdatfield,nameusermessage ) {
 
  const chatMessageDiv = document.createElement('div');
  chatMessageDiv.classList.add('d-flex', 'flex-row', 'justify-content-start');

  
  const avatarImg = document.createElement('img');
  avatarImg.src = img;  
  //'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp';
  avatarImg.alt = 'avatar 1';
  avatarImg.style.width = '45px';
  avatarImg.style.height = '100%';

    
 const nameElement = document.createElement('p');
  nameElement.classList.add('small', 'text-muted', 'mb-1');
  nameElement.textContent = nameusermessage;

  
  const textDiv = document.createElement('div');

 
  const messageParagraph = document.createElement('p');
  messageParagraph.classList.add('small', 'p-2', 'ms-3', 'mb-1', 'rounded-3', 'bg-body-tertiary');
  messageParagraph.textContent = textmessage;
  const timestampParagraph = document.createElement('p');
  timestampParagraph.classList.add('small', 'ms-3', 'mb-3', 'rounded-3', 'text-muted', 'float-end');
  timestampParagraph.textContent = createdatfield;
  textDiv.appendChild(nameElement);
  textDiv.appendChild(messageParagraph);
  textDiv.appendChild(timestampParagraph);
  chatMessageDiv.appendChild(avatarImg);
  chatMessageDiv.appendChild(textDiv);
  console.log(chatMessageDiv);

  return chatMessageDiv;
  }


</script>
@endsection




