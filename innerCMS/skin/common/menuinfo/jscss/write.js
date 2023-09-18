jQuery(function($){
	
	function menuTypeSet(){
		type = $('#menu_type').val();
		no = $('input[name="no"]').val();
		if(no == undefined) no = 0;
		
		$('.menu_type').hide();
		if(type != ''){
			$('.' + type).show();
		}
		
		setContentsEditor();
		setSkinEditor();
	}
	
	function setContentsEditor(){
		
		$('.contents iframe').remove();
		no = $('.setContents.btn_apply').data('no');
		if(no != undefined){
			html = getContents(no);
		}else{
			html = $('#contents').text(); 
		}
		
		if($('input[name="use_file"]:checked').val() == 1){
			editAreaLoader.init({
        		id: "contents"	// id of the textarea to transform		
        		,start_highlight: true	// if start with highlight
        		,allow_resize: "both"
        		,allow_toggle: true
        		,word_wrap: true
        		,language: "en"
        		,syntax: "html"
        		,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
				,min_height: 500	
        	});
			editAreaLoader.setValue("contents", html);
		}else{
			
			 nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "contents",
                sSkinURI: editor_url+"/SmartEditor2Skin.html",	
                htParams : {
                    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
					bSkipXssFilter : true,	// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                    fOnBeforeUnload : function(){
                        //alert("완료!");
                    }
                }, //boolean
                fOnAppLoad : function(){
					oEditors.getById['contents'].exec("SET_IR", ['']);
					oEditors.getById["contents"].exec("PASTE_HTML", [html]);
                },
                fCreator: "createSEditor2"
            });
		}
		
		
	}
	
	function getContents(no){
		
		data = $.ajax({
			type : "get",
			async : false,
			url : skinUrl + "setContentsAjax.php",
			data : {
				no : no
			},
			dataType : 'html',
			success : function(){
				
			}
		});
		html = data.responseText;
		return html;
	}
	

	function setSkinEditor(){
		
		$('.skin iframe').remove();
		$(".smarteditor2").each( function(index){
            var get_id = $(this).attr("id");

            if( !get_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;

			nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: get_id,
                sSkinURI: editor_url+"/SmartEditor2Skin.html",	
                htParams : {
                    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
					bSkipXssFilter : true,	// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                    fOnBeforeUnload : function(){
                        //alert("완료!");
                    }
                }, //boolean
                fOnAppLoad : function(){
                    //예제 코드
                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                },
                fCreator: "createSEditor2"
            });
          

        });
		
		
	}
	
	menuTypeSet();
	
	//메뉴 타입 셀렉트 박스 선택시
	$('#menu_type').change(function(){
		menuTypeSet();
		
	});
	
	//스킨 미리보기
	$('.skinThumb').hover(function(){
		$(this).find('.screenshot').show();
	},function(){
		$(this).find('.screenshot').hide();
	});
	
	//입력방식 클릭시
	$('input[name="use_file"]').click(function(){
		
		if($(this).val() == 0){
			if(!confirm('에디터 입력방식으로 변경하면 기존 작성된 내용이 사라지거나 정상적으로 저장이 되지 않을 수 있습니다.\n계속하시겠습니까?')){
				return false;	
			}
		}
		setContentsEditor();
	});
	
	//컨텐츠 수정 히스토리 클릭시
	$('.setContents').click(function(){
		
		$('.setContents').removeClass('btn_apply');
		$(this).addClass('btn_apply');
		
		no = $(this).data('no');
		html = getContents(no);
		
		if($('input[name="use_file"]:checked').val() == 1){
				editAreaLoader.setValue("contents", html);
		}else{
			oEditors.getById['contents'].exec("SET_IR", ['']);
			oEditors.getById['contents'].exec("PASTE_HTML", [html]);
		}
		
		return false;
	});
});