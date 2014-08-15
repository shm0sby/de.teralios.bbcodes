<a href="{@$__wcf->getAnchor($footnoteTagID)}" title="{if $footnoteTooltip != ''}{$footnoteTooltip}{else}{lang}wcf.bbcode.footnote.tooltip{/lang}{/if}" class="jsTooltip">
	{if BBCODES_FOOTNOTE_STYLE == 1}
		<sup><small>{$footnoteIndex}</small></sup>
	{elseif BBCODES_FOOTNOTE_STYLE == 2}
		[{$footnoteIndex}]
	{elseif BBCODES_FOOTNOTE_STYLE == 3}
		{'*'|str_repeat:$footnoteIndex}
	{else}
		<sup><small>{$footnoteIndex|romanize}</small></sup>
	{/if}
</a>