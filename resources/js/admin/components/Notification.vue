<template>
  <div>
    <li class="nav-item dropdown">
      <a
        class="nav-link"
        href="#"
        role="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        <i class="ni ni-bell-55"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
        <!-- Dropdown header -->
        <div class="px-3 py-3">
          <h6 class="text-sm text-muted m-0">
            You have
            <strong class="text-primary" v-text="messages.length"></strong> notifications.
          </h6>
        </div>

        <!-- List group -->
        <div class="list-group list-group-flush">
          <a
            href="#!"
            class="list-group-item list-group-item-action"
            v-for="(notif, index) in messages"
            :key="index"
          >
            <div class="row align-items-center">
              <div class="col ml-4">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="mb-0 text-sm" v-text="notif.username"></h4>
                  </div>

                  <div class="text-right text-muted">
                    <small>{{ moment(messages.date).fromNow() }}</small>
                  </div>
                </div>

                <p class="text-sm mb-0" v-text="notif.message"></p>
              </div>
            </div>
          </a>
        </div>

        <!-- View all -->
        <a
          href="/admin/orders"
          class="dropdown-item text-center text-primary font-weight-bold py-3"
        >View all</a>
      </div>
    </li>
  </div>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      messages: []
    };
  },

  created() {
    this.listenForChanges();
  },

  methods: {
    listenForChanges() {
      Echo.channel("new-order").listen(".order-event", order => {
        if (!("Notification" in window)) {
          alert("Web Notification is not supported");
          return;
        }

        var audio = new Audio(
          "http://soundbible.com/mp3/submarine-diving-alarm-daniel_simon.mp3"
        );
        audio.play();

        this.messages.push(order);

        Notification.requestPermission(permission => {
          let notification = new Notification("New order alert!", {
            body: order.username, // content for the alert
            icon: "https://i.picsum.photos/id/118/200/300.jpg" // optional image url
          });

          // link to page on clicking the notification
          notification.onclick = () => {
            window.open("window.location.href");
          };
        });
      });
    }
  }
};
</script>

<style scoped>
/*  */
</style>