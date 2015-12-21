/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
        
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    connected: false,
    show_default_splash_page_with_msg: function(){
        var msg = '<div id="internet-message" class="alert alert-danger">Your device is not online. Attempting to reconnect to the Internet...</div>';
        $("#internet-connection-msg").html(msg).show();
        $("#splash-img").css('display','block');  
    },
    show_default_splash_page: function(){
        var msg = '<div id="internet-message" class="alert alert-success">Loading...<div>';
        $("#internet-connection-msg").html(msg).show();
        $("#splash-img").css('display','block');  
    },
    hide_default_splash_page: function(){
        $("#internet-connection-msg").html('');
        $("#splash-img").css('display','none');
    },
    getInternetConnection: function(){
   
        if(navigator.onLine != undefined && navigator.onLine != null && navigator.onLine) { 
            app.connected = true;
        }
        else{
            app.connected = false;
        }

    },
    load_site_interval_ref: '',
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicity call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.getInternetConnection();
        
        setInterval(function(){

            app.getInternetConnection();

        }, 500);
    
        app.receivedEvent('deviceready');

        app.load_site_interval_ref = setInterval( function(){
            if(app.juniper === false){
                clearInterval(app.load_site_interval_ref);
                setTimeout(function(){ app.load_site(); }, 1000);
            }
        }, 500);


    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {

        
    },
    // result contains any message sent from the plugin call
    successHandler: function(result) {
        //alert('Callback Success! Result = '+result)
    },
    errorHandler:function(error) {
        //alert(error);
    },
    juniper: false,
    device: '',
    reg_id: '',
    window_ref: '',
    load_site: function() {
            
            if(app.connected === true) {

                app.hide_default_splash_page();

                var site_url = '';

                if(app.reg_id != ''){

                    site_url = 'http://delloverdrive.com/?device_id=' + app.reg_id;

                }
                else {

                    site_url = 'http://delloverdrive.com/';
                }

                app.window_ref = window.open(site_url, '_self', 'location=no');

                app.juniper = true;
                
                app.window_ref.addEventListener('exit', function() {
                    app.juniper = false;
                }, false);

            }
            else {

                app.juniper = false;
                app.show_default_splash_page_with_msg();
                
            }

            app.load_site_interval_ref = setInterval( function(){
                if(app.juniper === false){
                    clearInterval(app.load_site_interval_ref);
                    setTimeout(function(){ app.load_site(); }, 1000);
                }
            }, 500);
           
        
    }
};
