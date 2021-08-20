<template>
  <div class="py-5">
    <div class="message-container">
      <div class="container">
        <div class="card">
          <div class="heading px-3 py-3 border-bottom">
            <h3>Messages</h3>
          </div>
          <div class="outer-content">
            <div class="m-box sidebar scrollable">
              <div class="msg-header sticky">
                <form action="" class="form">
                  <!-- Searh -->
                  <div class="form-group">
                    <i class="fa fa-search"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Search"
                      v-model="searchFriend"
                    />
                  </div>
                  <!-- Searh -->
                </form>
              </div>
              <div class="user-lists">
                <!-- show User -->
                <div class="" v-if="showUsers">
                  <div
                    class="
                      user-list-item
                      d-flex
                      align-items-center
                      p-3
                      border-bottom
                    "
                    :key="friends.conversation_id"
                    :id="friends.conversation_id"
                    v-for="friends in orderedUsers"
                    @click="getSingleChat(friends)"
                  >
                    <div class="box">
                      <template v-if="userdata.id == friends.sender_id">
                        <template v-if="friends.receiver_info.img != null">
                          <img
                            :src="
                              'uploads/users/' +
                              friends.receiver_info.id +
                              '/images/' +
                              friends.receiver_info.img
                            "
                            alt=""
                          />
                        </template>
                        <template v-else>
                          <img src="assets/img/dashboard/avatar.jpg" alt="" />
                        </template>
                      </template>
                      <template v-else>
                        <template v-if="friends.sender_info.img != null">
                          <img
                            :src="
                              'uploads/users/' +
                              friends.sender_info.id +
                              '/images/' +
                              friends.sender_info.img
                            "
                            alt=""
                          />
                        </template>
                        <template v-else>
                          <img src="assets/img/dashboard/avatar.jpg" alt="" />
                        </template>
                      </template>
                    </div>
                    <div class="box w-100 pl-3">
                      <div
                        class="inner-box d-flex justify-content-between mb-1"
                      >
                        <template v-if="userdata.id == friends.sender_id">
                          <h6 class="">
                            {{ friends.receiver_info.name }}
                            <!-- {{ friends.receiver_info.last_name }} -->
                          </h6>
                        </template>
                        <template v-else>
                          <h6 class="">
                            {{ friends.sender_info.name }}
                            <!-- {{ friends.sender_info.last_name }} -->
                          </h6>
                        </template>
                        <div
                          :class="'lastMessageDate-' + friends.conversation_id"
                        >
                          <!-- <small
                            class="text-muted"
                            v-if="friends.message_id != 0"
                            >{{
                              istoday(friends.last_message.message_date)
                            }}</small
                          > -->
                        </div>
                      </div>
                      <!-- <div :class="'lastMessage-' + friends.conversation_id">
                        <template v-if="userdata.id == friends.sender_id">
                          <p
                            :id="'f_typing' + friends.receiver_id"
                            v-if="friends.message_id != 0"
                          >
                            {{ friends.last_message.message_desc }}
                          </p>
                        </template>
                        <template v-else>
                          <p
                            :id="'f_typing' + friends.sender_id"
                            v-if="friends.message_id != 0"
                          >
                            {{ friends.last_message.message_desc }}
                          </p>
                        </template>
                      </div> -->
                    </div>
                  </div>
                </div>
                <!-- /Show User -->
                <!-- Search User -->
                <div class="" v-if="searchUser">
                  <div
                    class="
                      user-list-item
                      d-flex
                      align-items-center
                      p-3
                      border-bottom
                    "
                    :key="friends.conversation_id"
                    :id="friends.conversation_id"
                    v-for="friends in filteredUserlist"
                    @click="getSingleChat(friends)"
                  >
                    <div class="box">
                      <template v-if="userdata.id == friends.sender_id">
                        <template v-if="friends.receiver_info.img != null">
                          <img
                            :src="
                              'uploads/users/' +
                              friends.receiver_info.id +
                              '/images/' +
                              friends.receiver_info.img
                            "
                            alt=""
                          />
                        </template>
                        <template v-else>
                          <img src="assets/img/dashboard/avatar.jpg" alt="" />
                        </template>
                      </template>
                      <template v-else>
                        <template v-if="friends.sender_info.img != null">
                          <img
                            :src="
                              'uploads/users/' +
                              friends.sender_info.id +
                              '/images/' +
                              friends.sender_info.img
                            "
                            alt=""
                          />
                        </template>
                        <template v-else>
                          <img src="assets/img/dashboard/avatar.jpg" alt="" />
                        </template>
                      </template>
                    </div>
                    <div class="box w-100 pl-3">
                      <div
                        class="inner-box d-flex justify-content-between mb-1"
                      >
                        <template v-if="userdata.id == friends.sender_id">
                          <h6 class="">
                            {{ friends.receiver_info.first_name }}
                            {{ friends.receiver_info.last_name }}
                          </h6>
                        </template>
                        <template v-else>
                          <h6 class="">
                            {{ friends.sender_info.first_name }}
                            {{ friends.sender_info.last_name }}
                          </h6>
                        </template>
                        <div
                          :class="'lastMessageDate-' + friends.conversation_id"
                        >
                          <small
                            class="text-muted"
                            v-if="friends.message_id != 0"
                            >{{
                              istoday(friends.last_message.message_date)
                            }}</small
                          >
                        </div>
                      </div>
                      <div :class="'lastMessage-' + friends.conversation_id">
                        <template v-if="userdata.id == friends.sender_id">
                          <p
                            :id="'f_typing' + friends.receiver_id"
                            v-if="friends.message_id != 0"
                          >
                            {{ friends.last_message.message_desc }}
                          </p>
                        </template>
                        <template v-else>
                          <p
                            :id="'f_typing' + friends.sender_id"
                            v-if="friends.message_id != 0"
                          >
                            {{ friends.last_message.message_desc }}
                          </p>
                        </template>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Search User -->
              </div>
            </div>
            <div class="m-box main-area" id="single_chat">
              <center id="selectConversation" class="mt-5 pt-5 mt-sm-5 pt-sm-5">
                <img
                  src="http://203.99.61.173/demos/gigtodo35/images/chat.png"
                  width="180"
                  alt=""
                />
                <h3 class="mt-3 empty-heading" style="font-weight: 410">
                  Select a Conversation
                </h3>
                <p class="lead">
                  Try selecting a conversation or searching for someone
                  specific.
                </p>
              </center>
              <div id="startchat" class="m-box" style="display: none">
                <div class="msg-header sticky">
                  <div class="user-info">
                    <h6>{{ friendName }}</h6>
                    <p>{{ friendStatus }}</p>
                  </div>
                  <!-- <div class="other d-flex align-items-center">
                  <button class="btn"><i class="fa fa-phone"></i></button>
                  <button class="btn">
                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown">
                    <button
                      class="btn"
                      type="button"
                      id="dropdownMenuButton"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton"
                    >
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div> -->
                </div>

                <div class="msg-body chat-widget-conversation">
                  <div class="msg-text-box" v-for="chat in singleChate">
                    <div class="panel d-flex align-items-start">
                      <div class="box">
                        <template v-if="chat.sender_info.img">
                          <img
                            :src="
                              'uploads/users/' +
                              chat.sender_info.id +
                              '/images/' +
                              chat.sender_info.img
                            "
                            alt=""
                          />
                        </template>
                        <template v-else>
                          <img src="assets/img/dashboard/avatar.jpg" alt="" />
                        </template>
                      </div>
                      <div class="box rounded w-100">
                        <div class="d-flex justify-content-between">
                          <h6>
                            {{ chat.sender_info.name }}
                            <!-- {{ chat.sender_info.last_name }} -->
                          </h6>
                          <small class="text-uppercase">{{
                            istoday(chat.message_date)
                          }}</small>
                        </div>
                        <template v-if="chat.message_file">
                          <div v-if="chat.message_type == 1">
                            <img
                              :src="'images/chat_images/' + chat.message_file"
                              alt="..."
                              class="img-thumbnail"
                              width="100"
                            />
                          </div>
                          <a
                            :href="'images/chat_images/' + chat.message_file"
                            download
                            class="d-block mt-2 ml-1"
                            style="color: rgb(0 153 255)"
                          >
                            <i class="fa fa-download"></i> message-{{
                              chat.message_file
                            }}
                          </a>
                        </template>
                        <p>{{ chat.message_desc }}</p>
                        <!-- <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Aperiam, mollitia!
                      </p> -->
                      </div>
                    </div>
                  </div>
                  <!-- <div class="msg-text-box right">
                  <div class="panel d-flex align-items-end">
                    <div class="box">
                      <img src="images/avatar (2).svg" alt="" />
                    </div>
                    <div class="box rounded p-2">
                      <div class="d-flex justify-content-between">
                        <h6>Carl Jenkins</h6>
                        <small class="text-uppercase ml-2">12:15 PM</small>
                      </div>
                      <p>Hi, Are you there?</p>
                    </div>
                  </div>
                </div> -->
                  <!-- <div class="past-date">
                  <div class="dropdown-divider"></div>
                  <h6 class="text-uppercase">
                    <small class="bg-white shadow-sm rounded p-2 px-3"
                      >DEC 22, 2020</small>
                  </h6>
                </div> -->
                </div>

                <div class="msg-footer align-items-center py-4 px-3">
                  <span v-show="typing" class="typing"
                    >{{ friendName }} is typing ...</span
                  >
                  <div id="myProgress" class="myProgress" style="display: none">
                    <div id="myBar" class="myBar"></div>
                  </div>
                  <div id="image"></div>
                  <div class="d-flex w-100">
                    <div class="footer-box">
                      <span class="form-field-file">
                        <label
                          for="cv-arquivo"
                          aria-label="Attach file"
                          class="btn1"
                        >
                          <i class="fa fa-paperclip" aria-hidden="true"></i>
                        </label>

                        <input
                          type="file"
                          @change="move()"
                          name="cv-arquivo"
                          ref="msg_file"
                          id="cv-arquivo"
                          class="field-file"
                        />
                      </span>
                    </div>
                    <div class="footer-box">
                      <input
                        type="text"
                        v-model="message"
                        v-on:keyup="removecross()"
                        class="form-control"
                        @keyup.enter="sendMessage()"
                      />
                    </div>
                    <div class="footer-box">
                      <button class="btn custom-btn" @click="sendMessage()">
                        send
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="m-box inner-content details-pane">
              <!-- <div class="inner-header">
                <h4>about</h4>
              </div> -->
              <div class="details-pane-body text-center mx-auto" v-if="showDetails">
                <div class="avatar " >
                  <template v-if="friendImage">
                    <img
                      :src="
                        'uploads/users/' + friendId + '/images/' + friendImage
                      " 
                      alt=""
                    />
                  </template>
                  <template v-else>
                    <img src="assets/img/dashboard/avatar.jpg" alt="" />
                  </template>
                </div>

                <div class="name-and-text">
                  <h5>{{ friendName }}</h5>
                  <!-- <p>top buyer | top rated seller</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueSocketio from "vue-socket.io";
import socketio from "socket.io-client";
import moment from "moment";

export default {
  props: ["userdata"],
  name: "App",
  data: function () {
    return {
      friendList: [],
      singleChate: {},
      friendId: "",
      friendName: "",
      friendImage: "",
      friendCountry: "",
      friendLanguage: "",
      friendStatus: "",
      searchFriend: "",
      post: "",
      message: "",
      check_image: "",
      conversation_id: "",
      showUsers: true,
      searchUser: false,
      typing: false,
      showDetails: false,
    };
  },
  sockets: {
    connect: function () {
      console.log("socket connected successfully");
    },

    disconnect() {
      console.log("socket disconnected");
    },

    alphastarttyping(data) {
      // this.typing = true;
      console.log('Start Typing'+ data);
      if (data.selectFrienddata == this.user_id) {
        const post2 = this.friendList
          .filter((obj) => {
            if (data.selectFrienddata === obj.sender_id) {
              return data.selectFrienddata === obj.sender_id;
            } else {
              return data.selectFrienddata === obj.receiver_id;
            }
          })
          .pop();
        // console.log("post2",post2);
        if (post2) {
          if (this.friendId == data.UserId && post2.sender_id == data.UserId) {
            this.typing = true;
          } else if (
            this.friendId == data.UserId &&
            post2.receiver_id == data.UserId
          ) {
            this.typing = true;
          }
          $("#f_typing" + data.UserId).html(
            '<span style="color: green;"> is typing ...</span>'
          );
          this.typing = false;
        }
      }
    },

    alphastoptyping(data) {
      this.typing = false;
      if (data.friendId == this.user_id) {
        console.log("stop typing friend", data.friendId);
        console.log("stop typing user", data.UserId);
        // alert("chenck");
        console.log("stop typing", data);

        if (data.selectFrienddata.last_message) {
          // setTimeout(() => $('#f_typing'+data.UserId).html('demo'+data.selectFrienddata.last_message.message_desc), 3000);
          $("#f_typing" + data.UserId).html(
            data.selectFrienddata.last_message.message_desc
          );
        } else {
          $("#f_typing" + data.UserId).html("type");
        }
      }
    },
  },
  mounted() {
    // console.log(this.userdata);
    // this.user_id = '1';
    this.user_id = this.userdata.id;
    this.profile_image = this.userdata.img;
    this.first_name = this.userdata.name;
    // this.first_name = 'Super Admin';
    // this.first_name = this.userdata.name;
    // this.last_name = this.userdata.last_name;
    this.user_names = this.userdata.username;
    // this.user_names = this.userdata.username;
    this.friendlistss();

    var socket = socketio("https://peekvideochat.com:22000");
    // var socket = socketio('http://192.168.100.17:3000');
    socket.on(
      "birdsreceivemsg",
      function (data) {
        console.log("socket data", data);
        if (data.message_receiver == this.userdata.id) {
          if (this.conversation_id == data.conversation_id) {
            this.singleChate.push(data);
          }
          //   this.userdec = this.friendList.filter((obj_friend) => {
          //     console.log(data.conversation_id,obj_friend.conversation_id);
          //     return data.conversation_id === obj_friend.conversation_id;
          // }).pop();

          this.userdec = this.friendList
            .filter((obj_friend) => {
              return data.conversation_id === obj_friend.conversation_id;
            })
            .pop();
          console.log("filter_user", this.userdec);
          // setTimeout(() => this.userdec.time = new Date().toISOString(), 3000);
          this.userdec.time = new Date().toISOString();
          // this.userdec.last_message.message_desc = data.message_desc;
          // // var time2 = moment().format('hh:mm A');
          // console.log('.lastMessageDate-'+data.conversation_id);
          // var msg=data.message_desc;
          // var time2 = moment().format('hh:mm A');
          // setTimeout(() => $('.lastMessage-'+this.conversation_id).html('<p>'+msg+'</p>'), 2000);
          // $('.lastMessageDate-'+data.conversation_id).html('<small class="text-muted text-uppercase"> TODAY AT '+time2+'</small>');
          // var time2 = moment().format('hh:mm A');
          //   $('.lastMessageDate-'+data.conversation_id).html('<small class="text-muted text-uppercase"> TODAY AT '+time2+'</small>');
          // $('.lastMessage-'+this.userdec.conversation_id).html('<p>data ape'+data.message_desc+'</p>');

          // console.log("check notfication",$('.notificationMessage-'+data.conversation_id).text());
          var height = 0;
          $(".chat-widget-conversation").each(function (i, value) {
            height += parseInt($(this).height());
          });
          height += 20000;
          $(".chat-widget-conversation").animate({ scrollTop: height });
        }
      }.bind(this)
    );
  },
  watch: {
    searchFriend() {
      if (this.searchFriend.length > 0) {
        this.showUsers = false;
        this.searchUser = true;
      } else {
        this.showUsers = true;
        this.searchUser = false;
      }
    },
    message: _.debounce(function () {
      this.$socket.emit("alphastopTyping", {
        selectFrienddata: this.singleChatUser,
        friendId: this.friendId,
        UserId: this.user_id,
      });
    }, 1500),
  },
  computed: {
    filteredUserlist() {
      return this.friendList.filter((post) => {
        // console.log(post.sender_info.first_name.toLowerCase().includes(this.searchFriend.toLowerCase()));
        if (post.sender_id == this.user_id) {
          return post.receiver_info.first_name
            .toLowerCase()
            .includes(this.searchFriend.toLowerCase());
        } else {
          return post.sender_info.first_name
            .toLowerCase()
            .includes(this.searchFriend.toLowerCase());
        }
      });
    },
    orderedUsers: function () {
      return _.orderBy(this.friendList, "time", "desc");
    },
  },
  methods: {
    istoday: function (date) {
      return moment(date).calendar();
    },
    removecross() {
      this.$socket.emit("alphamsgtyping", {
        selectFrienddata: this.friendId,
        UserId: this.user_id,
      });
    },
    friendlistss: function () {
      console.log("asdasd");
      axios.get("friendsList/" + this.user_id).then((responce) => {
        this.friendList = responce.data;
        console.log(this.friendList);
        var url = window.location.href;
        var conversation_id = url.substring(url.lastIndexOf("=") + 1);
        if (conversation_id) {
          const post = this.friendList
            .filter((obj) => {
              return conversation_id == obj.conversation_id;
            })
            .pop();
          if (post) {
            $("#" + post.conversation_id).addClass("active");
            // $('#1212577981').addClass('active');
            this.getSingleChat(post);
            var height = 0;
            // var container = this.$el.querySelector("#startchat");
            // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
            // console.log(container);
            $(".chat-widget-conversation").each(function (i, value) {
              height += parseInt($(this).height());
            });
            height += 20000;
            $(".chat-widget-conversation").animate({ scrollTop: height });
          }
        }
      });
    },
    getSingleChat: function (single) {
      this.singleChatUser = single;
      this.showDetails = true;
      // console.log(this.singleChatUser);
      $(".user-list-item.active").removeClass("active");
      $("#" + this.singleChatUser.conversation_id).addClass("active");
      $("#selectConversation").hide();
      $("#startchat").show();
      $("#single_chat").show();
      var height = 0;
      $(".chat-widget-conversation").each(function (i, value) {
        height += parseInt($(this).height());
      });
      height += 20000;
      $(".chat-widget-conversation").animate({ scrollTop: height });

      // console.log(this.singleChatUser);
      if (this.singleChatUser.sender_id == this.user_id) {
        // this.userImage=this.singleChatUser.sender_info.profileimage;
        this.friendName =
          // this.singleChatUser.receiver_info.first_name +
          // " " +
          this.singleChatUser.receiver_info.name;
        this.conversation_id = this.singleChatUser.conversation_id;
        this.friendId = this.singleChatUser.receiver_id;
        this.friendImage = this.singleChatUser.receiver_info.img;
        this.friendCountry = this.singleChatUser.receiver_info.country;
        this.friendStatus = this.singleChatUser.receiver_info.user_status;
        // this.message_status=this.singleChatUser.message_status;
        //console.log(this.friendImage);
      } else {
        this.friendName = this.singleChatUser.sender_info.name;
        // this.singleChatUser.sender_info.last_name;
        this.conversation_id = this.singleChatUser.conversation_id;
        this.friendId = this.singleChatUser.sender_id;
        this.friendImage = this.singleChatUser.sender_info.img;
        this.friendCountry = this.singleChatUser.sender_info.country;
        this.friendStatus = this.singleChatUser.sender_info.user_status;
        // this.userImage=this.singleChatUser.receiver_info.profileimage;
        // this.message_status=this.singleChatUser.message_status;
        //console.log(this.friendImage);
      }
      axios
        .post("singleChat", {
          sender_id: single.sender_id,
          receiver_id: single.receiver_id,
        })
        .then(
          (responce) => {
            console.log(responce.data);
            this.singleChate = responce.data;
            var checkimage = responce.data
              .filter((obj) => {
                return "1" == obj.message_type;
              })
              .pop();
            if (checkimage != undefined) {
              this.check_image = "1";
            } else {
              this.check_image = "0";
            }
            axios.get("api/friendData/" + this.friendId).then(
              (responce) => {
                this.friendLanguage = responce.data.languages;
              },
              function (err) {
                console.log("err", err);
                // alert("error");
              }
            );
          },
          function (err) {
            console.log("err", err);
            // alert("error");
          }
        );
    },
    sendMessage: function () {
      var socket = socketio.connect("https://peekvideochat.com:22000/");

      var config = {
        header: {
          "Content-Type": "multipart/form-data",
        },
      };
      // console.log(this.friendId);
      $("#image").text("");
      let meeting_file = this.$refs.msg_file.files;
      var meetingformDatas = new FormData();
      meetingformDatas.append("file", meeting_file[0]);
      meetingformDatas.append("message_sender", this.user_id);
      meetingformDatas.append("message_receiver", this.friendId);
      meetingformDatas.append("message", this.message);
      meetingformDatas.append("conversation_id", this.conversation_id);
      // meetingformDatas.append('message_status',this.message_status);

      var d = new Date($.now());
      var time =
        d.getFullYear() +
        "-" +
        (d.getMonth() + 1) +
        "-" +
        d.getDate() +
        " " +
        d.getHours() +
        ":" +
        d.getMinutes() +
        ":" +
        d.getSeconds();
      var message_type = 0;
      var filename = "";
      if (meeting_file.length > 0) {
        var message_type = 1;
        filename = meeting_file[0].name;
        // console.log(meeting_file[0]['type']);
        if (
          meeting_file[0]["type"] === "image/jpeg" ||
          meeting_file[0]["type"] === "image/png" ||
          meeting_file[0]["type"] === "image/jpg"
        ) {
          var message_type = "1";
        } else {
          var message_type = "2";
        }
      }
      var profile_image = "";
      if (this.profile_image != null) {
        profile_image = this.profile_image;
      }

      //
      var obj = {
        message_sender: this.user_id,
        message_receiver: this.friendId,
        message_desc: this.message,
        message_desc: this.message,
        message_file: filename,
        message_type: message_type,
        sender_info: {
          img: profile_image,
          id: this.user_id,
          name: this.first_name,
          // last_name: this.last_name,
        },
        // message_type: message_type,
        conversation_id: this.conversation_id,
        // message_status: this.message_status,
        created_at: time,
      };
      //console.log(filename+'hghghgh');
      // meetingformDatas.append('meetingformDatas', obj);
      // console.log(obj);
      // socket.emit('message', obj);

      axios.post("send-message", meetingformDatas, config).then((responce) => {
        this.singleChate.push(obj);
        var height = 0;
        $(".chat-widget-conversation").each(function (i, value) {
          height += parseInt($(this).height());
        });
        height += 20000;
        $(".chat-widget-conversation").animate({ scrollTop: height });
        socket.emit("message", obj);
        socket.emit("alphastopTyping", {
          selectFrienddata: this.friendId,
          UserId: this.user_id,
        });
        // var time = moment().format('hh:mm A');

        this.userdec = this.friendList
          .filter((obj_friend) => {
            return this.conversation_id === obj_friend.conversation_id;
          })
          .pop();
        // console.log("filter_user",this.userdec);
        this.userdec.time = new Date().toISOString();
        this.userdec.last_message.message_desc = this.message;
        var time2 = moment().format("hh:mm A");
        console.log(".lastMessageDate-" + this.conversation_id);
        var msg = this.message;
        // console.log(msg);
        // setTimeout(() => $('.lastMessage-'+this.conversation_id).html('<p>'+msg+'</p>'), 2000);
        $(".lastMessageDate-" + this.conversation_id).html(
          '<small class="text-muted text-uppercase"> TODAY AT ' +
            time2 +
            "</small>"
        );

        // this.userdec = this.friendList.filter((obj_friend) => {
        //   // console.log(obj_friend.sender_id);
        // if (obj_friend.sender_id == this.userdata.id) {
        //   return this.friendId === obj_friend.receiver_id;
        // }else {
        //   return this.friendId === obj_friend.sender_id;
        // }
        // if (obj_friend.receiver_id == this.userdata.id) {
        //   return this.friendId === obj_friend.sender_id;
        // }else {
        //   return this.friendId === obj_friend.receiver_id;
        // }
        // }).pop();
        // // console.log(this.userdec);
        // this.userdec.time = new Date().toISOString();
        // $('.lastMessageDate-'+this.conversation_id).html('<small class="text-muted text-uppercase"> TODAY AT '+time+'</small>');
        // console.log(this.conversation_id);
        // $('.lastMessage-'+this.conversation_id).html('<p>'+this.message+'</p>');

        this.message = "";
        this.$refs.msg_file.value = null;
      });
    },
    move: function () {
      var i = 0;
      $("#image").text("");
      if (i == 0) {
        i = 1;
        $("#myProgress").show();
        var elem = document.getElementById("myBar");
        var input = document.getElementById("cv-arquivo");
        var filename = input.files.item(0).name;
        var output = document.getElementById("image");
        var width = 1;
        var id = setInterval(frame, 1);
        function frame() {
          if (width >= 100) {
            $("#myProgress").hide();
            clearInterval(id);
            i = 0;
            output.innerHTML = filename;
          } else {
            width++;
            elem.style.width = width + "%";
          }
        }
      }
    },
  },
};
</script>
<style>
.message-container {
  padding: 20px 0;
}

.message-container ::-webkit-scrollbar {
  width: 4px;
}

.message-container ::-webkit-scrollbar-track {
  background: #f5f5f5;
}

.message-container ::-webkit-scrollbar-thumb {
  background: #007bff;
}

.message-container ::-webkit-scrollbar-thumb:hover {
  background: #62646a;
}

.message-container .heading h3 {
  font-size: 20px;
}

.message-container .outer-content {
  width: 100%;
  height: 500px;
  background: #ffffff;
  border-radius: 3px;
  display: -ms-grid;
  display: grid;
  -ms-grid-columns: 3fr 6fr 3fr;
  grid-template-columns: 3fr 6fr 3fr;
}

.message-container .outer-content .inner-content {
  width: 100%;
  height: 100%;
}

.message-container .outer-content .inner-content:nth-child(2) {
  border-left: 1px solid rgba(0, 0, 0, 0.1);
  border-right: 1px solid rgba(0, 0, 0, 0.1);
}

.message-container .outer-content .m-box {
  height: 500px;
}

.message-container .outer-content .active {
  border-left: 3px solid #007bff;
  background: rgba(0, 0, 0, 0.02);
}

.message-container .outer-content .sidebar {
  border-right: 1px solid rgba(0, 0, 0, 0.1);
}

.message-container .outer-content .sidebar .user-lists {
  overflow-y: auto;
  overflow-x: hidden;
  position: relative;
}

.message-container .outer-content .sidebar .user-lists img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.message-container .outer-content .sidebar .user-lists h6 {
  font-size: 15px;
}

.message-container .outer-content .sidebar .user-lists h6 small {
  font-size: 12px;
}

.message-container .outer-content .sidebar .user-lists p {
  font-size: 13px;
}

.message-container .outer-content .sidebar .msg-header {
  padding: 15px;
  background: #ffffff;
  -webkit-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.05);
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.05);
}

.message-container .outer-content .sidebar .msg-header .form-group {
  position: relative;
  margin-bottom: 0 !important;
}

.message-container .outer-content .sidebar .msg-header .form-group i.fa-search {
  position: absolute;
  top: 50%;
  left: 10px;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  opacity: 0.6;
}

.message-container .outer-content .sidebar .msg-header .form-group input {
  padding-left: 30px;
  min-height: 40px;
}

.message-container .outer-content .main-area {
  position: relative;
  background: #fafafa;
}

.message-container .outer-content .main-area .msg-header {
  padding: 15px;
  background: #ffffff;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
  height: 70px;
  -webkit-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.05);
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.05);
}

.message-container .outer-content .main-area .msg-header .user-info h6 {
  text-transform: capitalize;
  font-size: 16px;
  margin-bottom: 4px;
}

.message-container .outer-content .main-area .msg-header .user-info p {
  font-size: 13px;
  text-transform: capitalize;
}

.message-container .outer-content .main-area .other .btn {
  width: 30px;
  height: 30px;
  border-radius: 3px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  color: #007bff;
  margin-left: 6px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  background: rgba(0, 153, 255, 0.1);
}

.message-container .outer-content .main-area .other .btn:hover {
  color: #ffffff;
  background: #0099ff;
}

.message-container .outer-content .main-area .other .btn i.fa {
  font-size: 14px;
}

.message-container .outer-content .main-area .msg-body {
  height: calc(100% - 120px);
  padding: 20px;
  overflow-y: auto;
}

.message-container .outer-content .main-area .msg-body .past-date {
  position: relative;
  text-align: center;
  margin: 40px 0;
}

.message-container .outer-content .main-area .msg-body .past-date h6 {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.message-container .outer-content .main-area .msg-body .msg-text-box {
  margin-bottom: 30px;
}

.message-container .outer-content .main-area .msg-body .msg-text-box img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
}

.message-container .outer-content .main-area .msg-body .msg-text-box .box {
  background: transparent;
}

.message-container
  .outer-content
  .main-area
  .msg-body
  .msg-text-box
  .box
  small {
  color: #62646a;
}

.message-container .outer-content .main-area .msg-body .msg-text-box .box h6 {
  font-size: 15px;
  text-transform: capitalize;
}

.message-container .outer-content .main-area .msg-body .msg-text-box .box p {
  max-width: 90%;
  font-size: 13px;
  margin-top: 10px;
  color: #222325;
}

.message-container
  .outer-content
  .main-area
  .msg-body
  .msg-text-box
  .box:first-child {
  margin-right: 15px;
}

.message-container .outer-content .main-area .msg-footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  background: #ffffff;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-shadow: 0 -2px 3px rgba(0, 0, 0, 0.05);
  box-shadow: 0 -2px 3px rgba(0, 0, 0, 0.05);
}

.message-container
  .outer-content
  .main-area
  .msg-footer
  .footer-box:nth-child(2) {
  padding: 0 15px 0 20px;
  width: 100%;
}

.message-container
  .outer-content
  .main-area
  .msg-footer
  .footer-box:nth-child(2)
  input {
  min-height: 40px;
}

.message-container .outer-content .main-area .msg-footer .footer-box .btn {
  color: #ffffff;
  background: #007bff;
  height: 40px;
}

.message-container .outer-content .details-pane {
  overflow-y: auto;
  border-left: 1px solid rgba(0, 0, 0, 0.1);
}

.message-container .outer-content .details-pane .details-pane-body {
  padding: 0 25px;
}

.message-container .outer-content .details-pane .details-pane-body .avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
  margin: 20px auto;
}

.message-container .outer-content .details-pane .details-pane-body .avatar img {
  width: 100%;
  height: 100%;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .name-and-text {
  text-align: center;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .name-and-text
  h5 {
  font-size: 15px;
  margin-bottom: 10px;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .name-and-text
  p {
  font-size: 12px;
  text-transform: capitalize;
}

.message-container .outer-content .details-pane .details-pane-body .table {
  margin-top: 15px;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .table
  tr
  td {
  font-size: 12px;
  padding: 5px 0;
  text-transform: capitalize;
  border: 0;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .table
  tr
  td:last-child {
  text-align: right;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .table
  tr:first-child
  td:last-child
  span {
  color: #ffc107;
  font-weight: 500;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .all-doc-lists {
  margin: 20px 0;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .all-doc-lists
  h5 {
  font-size: 15px;
  text-transform: capitalize;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .all-doc-lists
  .doc-list-item {
  display: -ms-grid;
  display: grid;
  -ms-grid-columns: (1fr) [2];
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 10px;
  margin-top: 10px;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .all-doc-lists
  .doc-list-item
  .doc-item {
  width: 100%;
  height: 70px;
  border-radius: 10px;
  overflow: hidden;
}

.message-container
  .outer-content
  .details-pane
  .details-pane-body
  .all-doc-lists
  .doc-list-item
  .doc-item
  img {
  width: 100%;
  height: 100%;
}

.message-container .dropdown {
  text-align: right;
}

.message-container .dropdown .nav-link {
  padding: 0;
}

.message-container .dropdown .dropdown-menu {
  right: 0 !important;
  left: unset !important;
  -webkit-transform: unset !important;
  transform: unset !important;
  top: 30px !important;
}

.user-list-item {
  cursor: pointer;
}
.img-thumbnail {
  padding: 0.25rem;
  background-color: #fff;
  border: 1px solid #dee2e6;
  border-radius: 0.25rem !important;
  height: 100px !important;
  width: 100px !important;
}
.typing {
  position: absolute;
  top: -1px;
  left: 50px;
}
.myProgress {
  width: 100%;
  background-color: #ddd;
  position: absolute;
  top: 5px;
  width: 90%;
}

.myBar {
  width: 1%;
  height: 10px;
  background-color: #007bff;
}
#image {
  position: absolute;
  top: 0px;
}
/* .msg-body .msg-text-box.right .panel {
      -webkit-box-orient: horizontal;
      -webkit-box-direction: reverse;
      -ms-flex-direction: row-reverse;
      flex-direction: row-reverse;
  }
  .msg-body .msg-text-box.right .panel .box:first-child {
    margin-left: 15px;
}
.msg-body .msg-text-box.right .panel .box {
    max-width: 450px;
}
.msg-body .msg-text-box.right .panel .box:last-child {
    background: #007bff;
}
.msg-body .msg-text-box.right .panel .box:last-child p, .msg-body .msg-text-box.right .panel .box:last-child h6 {
    color: #ffffff;
}
.message-container .outer-content .main-area .msg-body .msg-text-box.right .box small {
    color: #ffffff;
} */
</style>
