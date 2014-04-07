<!-- Pro and Contra BBCode is part of de.teralios.tjs.bbcodes (Teralios.de) -->
<div class="tabularBox proContraBBCode">
	<div class="tabularBoxTitle"><header><h2>{$title}</h2></header></div>
	{if $points|empty}<div>{lang}wcf.bbcode.proContra.empty{/lang}</div>{/if}
	{if $proContraStyle|isset && $proContraStyle == 'old'}
		<div class="content styleOld">
			{if $points['pro']|count}
				<div class="pro">
					<ul>
						{foreach from=$points['pro'] item=$point}
							<li><span class="icon icon16 icon-plus-sign icon-pro"></span> {@$point}</li>
						{/foreach}
					</ul>
				</div>
			{/if}
			{if $points['contra']|count}
				<div class="contra">
					<ul>
						{foreach from=$points['contra'] item=$point}
							<li><span class="icon icon16 icon-minus-sign icon-contra"></span> {@$point}</li>
						{/foreach}
					</ul>
				</div>
			{/if}
			{if $points['neutral']|count}
				<div class="neutral">
					<ul>
						{foreach from=$points['neutral'] item=$point}
							<li><span class="icon icon16 icon-minus-sign"></span> {@$point}</li>
						{/foreach}
					</ul>
				</div>
			{/if}
		</div>
	{else}
		<div class="content styleNew">
				<div class="proAndContra">
					{if $points['pro']|count}
						<ul class="pro">
							{foreach from=$points['pro'] item=$point}
								<li><span class="icon icon16 icon-plus-sign icon-pro"></span> {@$point}</li>
							{/foreach}
						</ul>
					{/if}
					{if $points['contra']|count}
						<ul class="contra">
							{foreach from=$points['contra'] item=$point}
								<li><span class="icon icon16 icon-minus-sign icon-contra"></span> {@$point}</li>
							{/foreach}
						</ul>
					{/if}
					<span class="clearfix"></span>
				</div>
				<div class="neutral">
				{if $points['neutral']|count}
						<ul>
							{foreach from=$points['neutral'] item=$point}
								<li><span class="icon icon16 icon-minus-sign"></span> {@$point}</li>
							{/foreach}
						</ul>
					{/if}
				</div>
		</div>
	{/if}
</div>
