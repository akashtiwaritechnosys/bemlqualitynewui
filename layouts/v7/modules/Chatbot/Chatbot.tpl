<div id="block-crmdoctor-crmchatbot">
	<div class="chat-shell" role="application" aria-label="Dr. CRM chat">
		<div class="chat-header">
			<div class="bot-avatar">🤖</div>
			<div style="flex:1">
				<div class="header-title">BEML Bot</div>
				<div class="header-sub">Online</div>
			</div>
		</div>

		<div id="chatBody" class="chat-body" aria-live="polite">
			{* Initial bot bubble *}
			{*<div class="bubble msg-bot" id="welcome">*}
				{*Hello! I'm Dr. CRM Bot. Are you an existing customer?*}
				{*<div class="actions">
					<button class="quick-btn existing-cust-btn" data-action="existing-cust">Existing Customer</button>
					<button class="quick-btn new-visitor-btn" data-action="new-visitor">New Visitor</button>
				</div>*}
				{*<div class="meta">{{current_time}}</div> *}
			{*</div>*}
		</div>

		<div class="chat-footer">
			<button id="micBtn" class="mic-btn" title="Speak">
				<i class="fa-solid fa-microphone"></i>
			</button>
			<input id="chatInput" class="text-input" placeholder="Type your message..." aria-label="Message input">
			<button id="sendBtn" class="send-btn" title="Send">
				<i class="fa-solid fa-paper-plane"></i>
			</button>
		</div>
	</div>
	</div>
