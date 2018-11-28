{block name="title" prepend}Tourney{/block}
{block name="content"}
<style>
section#matches {
    margin: 25px 0 0 0;
}
section#matches.match-page {
    margin-top: 100px;
}
section#matches.match-page .navigation {
    display: flex;
    display: -webkit-flex;
    justify-content: center;
    -webkit-justify-content: center;
    padding: 36px 0;
}
section#matches.match-page .navigation .left {
    margin-right: 12px;
}
section#matches.match-page .navigation .left:hover svg path {
    fill: #39bffd;
}
section#matches.match-page .navigation .right:hover svg path {
    fill: #39bffd;
}
section#matches.match-page li.matchBox {
    position: relative;
}
section#matches.match-page li.matchBox:after {
    background-color: #39bffd;
    width: 3px;
    height: 100%;
    position: absolute;
    content: ' ';
    left: 0;
    top: 0;
    opacity: 0;
    -webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    -ms-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}
section#matches.match-page li.matchBox:hover:after {
    opacity: 1;
}
section#matches div.noMatchesBox {
    color: #fff;
    text-align: center;
    display: flex;
    display: -webkit-flex;
    justify-content:center;
    -webkit-justify-content:center;
    align-items: center;
    -webkit-align-items: center;
    background-color: #000;
    padding: 15px;
    height:100px;
}
section#matches .container {
    padding: 0;
}
section#matches div.container > div.content li.matchBox {
    background: rgba(34, 34, 46, 0.08);
    background: -moz-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, rgba(57, 191, 253, 0.08) 100%);
    background: -webkit-gradient(left top, right top, color-stop(0%, rgba(34, 34, 46, 0.08)), color-stop(100%, rgba(57, 191, 253, 0.08)));
    background: -webkit-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, rgba(57, 191, 253, 0.08) 100%);
    background: -o-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, rgba(57, 191, 253, 0.08) 100%);
    background: -ms-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, rgba(57, 191, 253, 0.08) 100%);
    background: linear-gradient(to right, rgba(34, 34, 46, 0.08) 0%, rgba(57, 191, 253, 0.08) 100%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#22222e', endColorstr='#39bffd', GradientType=1);
    height: 143px;
    width: 100%;
    padding: 25px 45px;
    display: flex;
    display: -webkit-flex;
    flex-direction: row;
    -webkit-flex-direction: row;
    flex-wrap: no-wrap;
    -webkit-flex-wrap: no-wrap;
    align-items: center;
    -webkit-align-items: center;
}
section#matches div.container > div.content li.matchBox:not(:last-child) {
    margin-bottom: 8px;
}
section#matches div.container > div.content ul#UpcomingMatches {
    display: none;
}
section#matches div.container > div.content ul.tab {
    display: none;
}
section#matches div.container > div.content ul.tab.active {
    display: block;
}
section#matches div.container > div.content ul#LatestResults {
    display: none;
}
section#matches div.container > div.content ul#UpcomingMatches.active {
    display: block;
}
section#matches div.container > div.content ul#LatestResults.active {
    display: block;
}
section#matches div.container > div.content li.matchBox > div.teams {
    display: flex;
    display: -webkit-flex;
    align-items: center;
    -webkit-align-items: center;
    padding-right: 54px;
    position: relative;
}
section#matches div.container > div.content li.matchBox > div.teams:after {
    content: ' ';
    display: block;
    position: absolute;
    right: 0;
    top: 9px;
    background-color: #26262e;
    width: 1px;
    height: 82px;
}
section#matches div.container > div.content li.matchBox > div.teams > a {
    text-decoration: none;
    display: inline-block;
    font-family: "Ubuntu", sans-serif;
    font-size: 0.75em;
    font-weight: bold;
    text-align: center;
    color: #b7b9bd;
    text-transform: uppercase;
    -webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    -ms-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}
section#matches div.container > div.content li.matchBox > div.teams > a:hover {
    opacity: .6;
}
section#matches div.container > div.content li.matchBox > div.teams > a > img {
    width: auto;
    max-height: 66px;
    display: block;
    margin: 0 auto 15px;
}
section#matches div.container > div.content li.matchBox > div.teams > span {
    display: block;
    margin: 0 40px;
    font-family: "Ubuntu", sans-serif;
    font-size: 0.75em;
    font-weight: bold;
    color: #b7b9bd;
    width: 48px;
    height: 48px;
    background-color: #1e1e27;
    text-align: center;
    line-height: 48px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    border: 1px solid #2f2f3a;
}
section#matches div.container > div.content li.matchBox > div.teams > span.score {
    background: transparent;
    font-family: "Ubuntu", sans-serif;
    font-weight: bold;
    color: #ffffff;
    width:70px;
    border: 0;
    margin:0 20px;
    font-size: 1.375em;
}
section#matches div.container > div.content li.matchBox > div.rightBox {
    display: flex;
    display: -webkit-flex;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info {
    padding: 0 47px;
    line-height: 1;
    position: relative;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info:after {
    content: ' ';
    display: block;
    position: absolute;
    right: 0;
    top: -7px;
    background-color: #26262e;
    width: 1px;
    height: 82px;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info > span.league {
    color: #39bffd;
    font-size: 0.875em;
    font-family: "Ubuntu", sans-serif;
    display: block;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info > div.status {
    margin: 12px 0;
    text-transform: uppercase;
    font-family: "Ubuntu", sans-serif;
    font-weight: bold;
    color: #fff;
    font-size: 0.875em;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info > div.status > span {
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    border-radius: 6px;
    padding: 5px 13px;
    font-size: 0.75em;
    margin-right: 6px;
    background-color: #de442b;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info > span.date {
    color: #66696e;
    font-size: 0.875em;
    font-family: "Ubuntu", sans-serif;
    display: block;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream {
    padding-left: 60px;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > a {
    text-decoration: none;
    color: #39bffd;
    font-size: 0.875em;
    font-family: "Ubuntu", sans-serif;
    margin-bottom: 8px;
    display: block;
    text-transform: capitalize;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > span {
    padding: 5px 13px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    border-radius: 6px;
    display: inline-block;
    text-transform: uppercase;
    font-size: 0.75em;
    font-family: "Ubuntu", sans-serif;
    font-weight: bold;
    color: #fff;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > span.youtube {
    background-color: #e52d27;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > span.mixer {
    background-color: #000;
}
section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > span.twitch {
    background-color: #6442a3;
}
section#matches div.container > div.content li.matchBox > a.cta-btn {
    display: block;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    border-radius: 6px;
    width: 32px;
    height: 20px;
    background-color: #39bffd;
    text-align: center;
    color: #fff;
    margin-left: auto;
    -webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    -ms-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}
section#matches div.container > div.content li.matchBox > a.cta-btn:hover {
    opacity: .8;
}
section#matches div.container > div.content li.matchBox > a.cta-btn svg {
    position: relative;
    top: -2px;
}
</style>
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;margin-bottom:2px;">
    	{$LNG.buddy_4}
       
    </div>
         
                <section id="matches">

        <div class="container">

            <!-- /SECTION-HEADER -->

            <div class="tab-content content">

                                <ul id="team_a" class="tab active">

					                        <li class="matchBox">
                            <div class="teams">
                                <a href="http://themes.pixiesquad.com/pixiehuge/orange-elite/team/midnight-turtles">
                                    <img src="http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/logo2.png" alt="Team's logo">
                                    <span>Midnight Turtles</span>
                                </a>
                                <span class="vs">VS</span>
                                <a href="http://themes.pixiesquad.com/pixiehuge/orange-elite/team/rhyno-domynos">
                                    <img src="http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/intz.png" alt="Team's logo">
                                    <span>Rhyno Domynos</span>
                                </a>
                            </div>
                            <!-- /TEAMS -->

                            <div class="rightBox">
                                <div class="match-info">
                                    <span class="league">SL i-League StarSeries S3</span>
                                    <div class="status">
                                        <span>Online</span> Vainglory                                    </div>
                                                                        <span class="date">16 June at 02:05 AM</span>
                                </div>
                                <!-- /MATCH INFO -->

                                                            </div>
                            <a href="http://themes.pixiesquad.com/pixiehuge/orange-elite/match/2-midnight-turtles-rhyno-domynos" class="cta-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"></path>
                                </svg>
                            </a>
                        </li>
                        <!-- /MATCH-BOX -->
                            
                                    </ul>
                
          
                            </div>
            <!-- /CONTENT -->
        </div>
        <!-- /CONTAINER -->

    </section>
        		 
               
                    <div class="clear"></div>               
                                            </div> <!--/ach_content_text-->                
                </div> <!--/ach_content-->

                            

{/block}
{block name="script" append}
{/block}