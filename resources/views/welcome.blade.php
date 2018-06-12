<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Laravel with Socket.io</title>
</head>
<body>
    <h1>Registered users</h1>
    <ul>
        <li v-for="user in users"> @{{ user }} </li>
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    <script>
        let socket = io("{{ env('APP_URL') }}:3000")
        
        new Vue({
            el: 'ul',
            data: {
                users: []
            },
            mounted() {
                socket.on('channel:UserSignedUp', function(data){
                    this.users.push(data.username)
                }.bind(this))
            }
        })
    </script>
</body>
</html>
