<ol class="flexibleButtonGroup optionTypeBoolean">
	<li>
		<input type="radio" id="{$option->optionName}"{if $value == 1} checked{/if} name="values[{$option->optionName}]" value="1"{if $disableOptions || $enableOptions} class="jsEnablesOptions" data-is-boolean="true" data-disable-options="[ {@$disableOptions}]" data-enable-options="[ {@$enableOptions}]"{/if}>
		<label for="{$option->optionName}" class="green"><span class="icon icon16 fa-check"></span> {lang}wcf.acp.option.type.boolean.yes{/lang}</label>
	</li>
	<li>
		<input type="radio" id="{$option->optionName}_no"{if $value == 0} checked{/if} name="values[{$option->optionName}]" value="0"{if $disableOptions || $enableOptions} class="jsEnablesOptions" data-is-boolean="true" data-disable-options="[ {@$disableOptions}]" data-enable-options="[ {@$enableOptions}]"{/if}>
		<label for="{$option->optionName}_no" class="red"><span class="icon icon16 fa-times"></span> {lang}wcf.acp.option.type.boolean.no{/lang}</label>
	</li>
	{if $option->optionName|mb_strpos:'admin.' !== 0 && ($group === null || (!$group->isEveryone() && !$group->isUsers()))}
		<li>
			<input type="radio" id="{$option->optionName}_never"{if $value == -1} checked{/if} name="values[{$option->optionName}]" value="-1"{if $disableOptions || $enableOptions} class="jsEnablesOptions" data-is-boolean="true" data-disable-options="[ {@$disableOptions}]" data-enable-options="[ {@$enableOptions}]"{/if}>
			<label for="{$option->optionName}_never" class="yellow"><span class="icon icon16 fa-ban"></span> {lang}wcf.acp.option.type.boolean.never{/lang}</label>
		</li>
	{/if}
</ol>
