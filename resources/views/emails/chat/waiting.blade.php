@component('mail::message')
# New Support Chat Waiting

Hello,

A new visitor has started a conversation and is waiting for assistance.

**Visitor Name:** {{ $conversation->visitor_name ?? 'Guest' }}  
**Visitor Email:** {{ $conversation->visitor_email ?? 'Not provided' }}

@component('mail::button', ['url' => $dashboardUrl])
View Conversation
@endcomponent

Please respond as soon as possible.

Thanks,<br>
{{ $companyName }}
@endcomponent