import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Pusher = Pusher

const echo = new Echo({
  broadcaster: 'pusher',
  key: 'test-key',
  cluster: 'mt1',
  encrypted: true,
  wsHost: window.location.hostname,
  wsPort: 6001,
  wssPort: 6001,
  forceTLS: false,
  enabledTransports: ['ws', 'wss'],
})

export default echo
