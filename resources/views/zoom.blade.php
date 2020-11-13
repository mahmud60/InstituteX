<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Meeting</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>


        <!-- import #zmmtg-root css -->
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.1/css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.1/css/react-select.css" />

    </head>
    <body>
        <style>
            .sdk-select {
                height: 34px;
                border-radius: 4px;
            }

            .websdktest button {
                float: right;
                margin-left: 5px;
            }

            #nav-tool {
                margin-bottom: 0px;
            }

            #show-test-tool {
                position: absolute;
                top: 100px;
                left: 0;
                display: block;
                z-index: 99999;
            }

            #display_name {
                width: 250px;
            }


            #websdk-iframe {
                width: 700px;
                height: 500px;
                border: 1px;
                border-color: red;
                border-style: dashed;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                left: 50%;
                margin: 0;
            }
        </style>

        <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Zoom WebSDK</a>
                </div>
                <div id="navbar" class="websdktest">
                    <form class="navbar-form navbar-right" id="meeting_form">
                        <div class="form-group">
                            <input type="text" name="display_name" id="display_name" value="1.8.1#CDN" maxLength="100"
                                placeholder="Name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="meeting_number" id="meeting_number" value="" maxLength="200"
                                style="width:150px" placeholder="Meeting Number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px"
                                maxLength="32" placeholder="Meeting Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="meeting_email" id="meeting_email" value="" style="width:150px"
                                maxLength="32" placeholder="Email option" class="form-control">
                        </div>

                        <div class="form-group">
                            <select id="meeting_role" class="sdk-select">
                                <option value=0>Attendee</option>
                                <option value=1>Host</option>
                                <option value=5>Assistant</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="meeting_china" class="sdk-select">
                                <option value=0>Global</option>
                                <option value=1>China</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="meeting_lang" class="sdk-select">
                                <option value="en-US">English</option>
                                <option value="de-DE">German Deutsch</option>
                                <option value="es-ES">Spanish Español</option>
                                <option value="fr-FR">French Français</option>
                                <option value="jp-JP">Japanese 日本語</option>
                                <option value="pt-PT">Portuguese Portuguese</option>
                                <option value="ru-RU">Russian Русский</option>
                                <option value="zh-CN">Chinese 简体中文</option>
                                <option value="zh-TW">Chinese 繁体中文</option>
                                <option value="ko-KO">Korean 한국어</option>
                                <option value="vi-VN">Vietnamese Tiếng Việt</option>
                                <option value="it-IT">Italian italiano</option>
                            </select>
                        </div>

                        <input type="hidden" value="" id="copy_link_value" />
                        <button type="submit" class="btn btn-primary" id="join_meeting">Join</button>
                        <button type="submit" class="btn btn-primary" id="clear_all">Clear</button>
                        <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')"
                            class="btn btn-primary" id="copy_join_link">Copy Direct join link</button>


                    </form>
                </div>
                <!--/.navbar-collapse -->
            </div>
        </nav>


        <div id="show-test-tool">
            <button type="submit" class="btn btn-primary" id="show-test-tool-btn"
                title="show or hide top test tool">Show</button>
        </div>
        <script>
            document.getElementById('show-test-tool-btn').addEventListener("click", function (e) {
                var textContent = e.target.textContent;
                if (textContent === 'Show') {
                    document.getElementById('nav-tool').style.display = 'block';
                    document.getElementById('show-test-tool-btn').textContent = 'Hide';
                } else {
                    document.getElementById('nav-tool').style.display = 'none';
                    document.getElementById('show-test-tool-btn').textContent = 'Show';
                }
            })
        </script>

        <script src="https://source.zoom.us/1.8.1/lib/vendor/react.min.js"></script>
        <script src="https://source.zoom.us/1.8.1/lib/vendor/react-dom.min.js"></script>
        <script src="https://source.zoom.us/1.8.1/lib/vendor/redux.min.js"></script>
        <script src="https://source.zoom.us/1.8.1/lib/vendor/redux-thunk.min.js"></script>
        <script src="https://source.zoom.us/1.8.1/lib/vendor/jquery.min.js"></script>
        <script src="https://source.zoom.us/1.8.1/lib/vendor/lodash.min.js"></script>

        <script src="https://source.zoom.us/zoom-meeting-1.8.1.min.js"></script>
        <script src="js/tool.js"></script>
        <script src="js/vconsole.min.js"></script>
        <script src="js/index.js"></script>

        <script>


        </script>
    </body>
</html>
