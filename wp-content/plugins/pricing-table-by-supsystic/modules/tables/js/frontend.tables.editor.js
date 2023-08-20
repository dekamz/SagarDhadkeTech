var g_ptsMainMenu = null
,	g_ptsFileFrame = null	// File frame for wp media uploader
,	g_ptsEdit = true
,	g_ptsTopBarH = 32		// Height of the Top Editor Bar
,	g_ptsSortInProgress = false
,	g_ptsEditMode = true	// If this script is loaded - this mean that we in edit mode
,	g_ptsUndoBuffer = []
,	g_ptsUndoBufferLength = 10
,	g_ptsUndoCurElement = -1
,	g_ptsAllowAddUndo = false
,	g_ptsVandColorPickerOptions = {
		'altAlpha': false,
		'showOn': 'alt',
		'altProperties': 'background-color',
		'altColorFormat': 'rgba(rd,gd,bd,af)',
		'okOnEnter': true,
		'stop': function () { _ptsAddUndoBuffer(true); },
		//'mode': 's',
		'alpha': true,
		'color': 'rgba(255, 255, 255, 0.8)',
		'colorFormat': 'RGBA',
		'title': 'Pick a color',
		'part': { 'map': { size: 128 }, 'bar': { size: 128 } },
		'parts': [ 'map', 'bar', 'rgb', 'alpha', 'hex', 'preview' ],
		'layout': {'map':		[0, 0, 1, 4],'bar':		[1, 0, 1, 4],'preview':	[2, 0, 1, 1],'rgb':		[2, 1, 1, 1],'alpha':  	[2, 2, 1, 1],'hex':		[2, 3, 1, 1],},
};
jQuery(document).ready(function(){
	_ptsInitTwig();
	// Prevent all default browser event - such as links redirecting, forms submit, etc.
	jQuery('#ptsCanvas').on('click', 'a', function(event){
		event.preventDefault();
	});
	jQuery('.ptsMainSaveBtn').click(function(){
		_ptsSaveCanvas();
		return false;
	});
	jQuery('#ptsUndoButton').click(function(){
		_ptsShowProcessing(true);
		setTimeout(function() {
      		_ptsUndoCanvas();
      		_ptsShowProcessing(false);
    	}, 5);
		return false;
	});
	jQuery('#ptsRedoButton').click(function(){
		_ptsShowProcessing(true);
		setTimeout(function() {
      		_ptsRedoCanvas();
      		_ptsShowProcessing(false);
    	}, 5);
		return false;
	});
});
function _ptsShowProcessing(show) {
	jQuery('#ptsUndoProcess').css('display', show ? 'inline-block' : 'none');
}
function _ptsSetUndoDelay(delay) {
	delay = delay ? delay : 200;
	setTimeout(function() {
      g_ptsAllowAddUndo = true;
    }, delay);
}
function _ptsAddUndoBuffer(isChange, refresh, force) {
	if(!g_ptsAllowAddUndo || g_ptsSortInProgress) return;
	if(jQuery(!isChange && '.mce-edit-focus').length > 0) return;
	if(jQuery('.mce-floatpanel:visible:not(.mce-tinymce)').length > 0) return;
	if(jQuery('.ptsCellEditBtnsShell.active').length > 0 || jQuery('.ptsMenuSubOpened.active').length > 0) return;
	if(jQuery('.media-modal:visible').length > 0) return;

	var block = g_ptsBlockFabric._blocks[0];
	block.checkColWidthPerc();
	block._refreshCellsHeight();

	var curLength = g_ptsUndoBuffer.length,
		data = ptsGetFabric().getDataForSave()[0],
		canvasHtml = data['html'].trim(),
		canvasCss = jQuery('.ptsBlockStyle').html();

	if(curLength > 0) {
		var last = g_ptsUndoBuffer[(g_ptsUndoCurElement < 0 ? curLength - 1 : g_ptsUndoCurElement)];
		if(!force && last['html'] == canvasHtml && last['css'] == canvasCss) return;
	}

	jQuery('.ptsSettingsContent .icheckbox_minimal').each(function(){
		var $this = jQuery(this),
			input = $this.find('input');

		if($this.hasClass('checked')) {
			input.attr('checked', true);
		} else {
			input.removeAttr('checked');
		}
	});

	jQuery('.ptsSettingsContent input').iCheck('destroy');

	var	attrClass = jQuery('.ptsBlock').attr('class'),
		attrStyle = jQuery('.ptsBlock').attr('style'),
		settings = jQuery('.ptsSettingsContent').clone(true, true).html(),
		params = _ptsGetTableBlock().get('params'),
		paramsArr = [];

	for(var key in params) {
		paramsArr.push({key: key, val: params[key].val});
	}
	_ptsInitSettings(false);
	ptsInitCustomCheckRadio('.ptsSettingsContent');

	if(refresh) {
		if(g_ptsUndoCurElement >= 0) {
			g_ptsUndoBuffer[g_ptsUndoCurElement] = {html: canvasHtml, css: canvasCss, settings: settings, attrClass: attrClass, attrStyle: attrStyle, params: paramsArr};
		}
	} else {
		if(g_ptsUndoCurElement >= 0) {
			var delta = curLength - g_ptsUndoCurElement - 1;
			if(delta > 0) {
				g_ptsUndoBuffer.splice(g_ptsUndoCurElement + 1, delta);
			}
		}
		if(curLength > g_ptsUndoBufferLength) {
			g_ptsUndoBuffer.shift();
		}
		g_ptsUndoBuffer.push({html: canvasHtml, css: canvasCss, settings: settings, attrClass: attrClass, attrStyle: attrStyle, params: paramsArr});
		g_ptsUndoCurElement = -1;
		if(g_ptsUndoBuffer.length > 1) {
			jQuery('#ptsUndoButton').removeAttr('disabled');
		}
		jQuery('#ptsRedoButton').attr('disabled', 'disabled');
	}
	g_ptsAllowAddUndo = false;
	_ptsSetUndoDelay();
}
function _ptsRefreshTable(num) {
	var $tbl = jQuery('.ptsBlockContent').closest('.ptsBlock'),
		block = g_ptsBlockFabric._blocks[0],
		settings = jQuery('.ptsSettingsContent');

	block.setRaw($tbl);
	jQuery('.ptsBlock').attr('class', g_ptsUndoBuffer[num]['attrClass']);
	jQuery('.ptsBlock').attr('style', g_ptsUndoBuffer[num]['attrStyle']);
	jQuery('#containerWrapper .ptsSettingsTabs a.nav-tab-active').trigger('click');
	_ptsInitSettings(true);
	ptsInitCustomCheckRadio('.ptsSettingsContent');

	settings.find('select.chosen').each(function(){
		var $this = jQuery(this),
			selected = $this.parent().find('a.chosen-single span').text();
		$this.find('option').removeAttr('selected');
		$this.find('option[value="'+selected+'"]').prop('selected', true);
	});

	settings.find('.chosen-container').remove();
	settings.find('.chosen').chosen({disable_search_threshold: 5});

	var block = _ptsGetTableBlock(),
		paramsArr = g_ptsUndoBuffer[num]['params'];
	for(var i in paramsArr) {
		block.setParam(paramsArr[i]['key'], paramsArr[i]['val']);
	}
	_ptsAddUndoBuffer(false, true);
}
function _ptsSetTableFromBuffer(num) {
	jQuery('.ptsBlockContent').html(g_ptsUndoBuffer[num]['html']);
	jQuery('.ptsBlockStyle').html(g_ptsUndoBuffer[num]['css']);
	jQuery('.ptsSettingsContent').html(g_ptsUndoBuffer[num]['settings']);
	_ptsRefreshTable(num);
}
function _ptsUndoCanvas() {
	var curLength = g_ptsUndoBuffer.length;

	if(curLength == 0) return;
	g_ptsAllowAddUndo = false;
	g_ptsUndoCurElement = (g_ptsUndoCurElement < 0 || g_ptsUndoCurElement >= curLength ? curLength - 2 : g_ptsUndoCurElement - 1);
	if(g_ptsUndoCurElement >= 0) {
		_ptsSetTableFromBuffer(g_ptsUndoCurElement);
	}
	jQuery('#ptsRedoButton').removeAttr('disabled');
	if(g_ptsUndoCurElement <= 0) {
		jQuery('#ptsUndoButton').attr('disabled', 'disabled');
	}
	_ptsSetUndoDelay();
}
function _ptsRedoCanvas() {
	var curLength = g_ptsUndoBuffer.length;

	if(curLength == 0) return;
	g_ptsAllowAddUndo = false;
	g_ptsUndoCurElement++;
	if(g_ptsUndoCurElement < curLength) {
		_ptsSetTableFromBuffer(g_ptsUndoCurElement);
	}
	jQuery('#ptsUndoButton').removeAttr('disabled');
	if(g_ptsUndoCurElement >= curLength - 1) {
		jQuery('#ptsRedoButton').attr('disabled', 'disabled');
	}
	_ptsSetUndoDelay();
}
function _ptsSaveCanvasDelay(delay) {
	delay = delay ? delay : 200;
	setTimeout(_ptsSaveCanvas, delay);
}
function _ptsSaveCanvas(params, byHands) {
	if(!!parseInt(toeOptionPts('disable_autosave')) && 'undefined' == typeof byHands) {
		return;	// Autosave disabled in admin area
	}
	if(typeof(ptsTables) === 'undefined' || !ptsTables || !ptsTables.length || (typeof(g_ptsIsTableBuilder) !== 'undefined' && g_ptsIsTableBuilder)) {
		return;
	}
	if(typeof(ptsTables[0].params.enable_switch_toggle) != 'undefined' && ptsTables[0].params.enable_switch_toggle.val == 0){
		//toggle options not enabled
	} else {
		//toggle enabled
		jQuery(document.body).trigger('updateToggleHtml');
	}

	params = params || {};
   savedData = ptsGetFabric().getDataForSave()[0]; //[0] - is because only one block (table) is in this plugin saved
	var dataForSave = {
		mod: 'tables'
	,	action: 'save'
   ,  pts_nonce: PTS_NONCE['pts_nonce']
	,	data: savedData
	};
	if(params.sendData) {
		for(var key in params.sendData) {
			dataForSave.data[ key ] = params.sendData[ key ];
		}
	}
	jQuery.sendFormPts({
		btn: jQuery('.ptsTableSaveBtn')
	,	data: dataForSave
	,	onSuccess: function(res){
			if(!res.error) {

			}
		}
	});
}
function _ptsSortInProgress() {
	return g_ptsSortInProgress;
}
function _ptsSetSortInProgress(state) {
	g_ptsSortInProgress = state;
}
function _ptsInitTwig() {
	Twig.extendFunction('adjBs', function(hex, steps) {
		if(!hex)
			return hex;
		var isRgb = hex.indexOf('rgb') !== -1;
		if(isRgb) {
			var colorObj = tinycolor( hex );
			hex = colorObj.toHex();
		}
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		steps = Math.max(-255, Math.min(255, steps));
		// Normalize into a six character long hex string
		hex = str_replace(hex, '#', '');
		if (hex.length == 3) {
			hex = str_repeat(hex.substr(0, 1), 2)+ str_repeat(hex.substr(1, 1), 2)+ str_repeat(hex.substr(2, 1), 2);
		}
		// Split into three parts: R, G and B
		var color_parts = str_split(hex, 2);
		var res = '#';
		for(var i in color_parts) {
			var color = color_parts[ i ];
			color   = hexdec(color); // Convert to decimal
			color   = Math.max(0, Math.min(255, color + steps)); // Adjust color
			res += str_pad(dechex(color), 2, '0', 'STR_PAD_LEFT'); // Make two char hex code
		}
		if(isRgb) {
			return tinycolor( res ).setAlpha( colorObj.getAlpha() );
		}
		return res;
	});
}
