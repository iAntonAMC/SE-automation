/**
 * @license Copyright (c) 2014-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
import DecoupledDocumentEditor from '@ckeditor/ckeditor5-editor-decoupled/src/decouplededitor.js';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment.js';
import AutoImage from '@ckeditor/ckeditor5-image/src/autoimage.js';
import AutoLink from '@ckeditor/ckeditor5-link/src/autolink.js';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold.js';
import CloudServices from '@ckeditor/ckeditor5-cloud-services/src/cloudservices.js';
import DataFilter from '@ckeditor/ckeditor5-html-support/src/datafilter.js';
import DocumentList from '@ckeditor/ckeditor5-list/src/documentlist.js';
import DocumentListProperties from '@ckeditor/ckeditor5-list/src/documentlistproperties.js';
import EasyImage from '@ckeditor/ckeditor5-easy-image/src/easyimage.js';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials.js';
import ExportPdf from '@ckeditor/ckeditor5-export-pdf/src/exportpdf.js';
import ExportWord from '@ckeditor/ckeditor5-export-word/src/exportword.js';
import FontBackgroundColor from '@ckeditor/ckeditor5-font/src/fontbackgroundcolor.js';
import FontColor from '@ckeditor/ckeditor5-font/src/fontcolor.js';
import FontFamily from '@ckeditor/ckeditor5-font/src/fontfamily.js';
import FontSize from '@ckeditor/ckeditor5-font/src/fontsize.js';
import FormatPainter from '@ckeditor/ckeditor5-format-painter/src/formatpainter.js';
import GeneralHtmlSupport from '@ckeditor/ckeditor5-html-support/src/generalhtmlsupport.js';
import Heading from '@ckeditor/ckeditor5-heading/src/heading.js';
import Highlight from '@ckeditor/ckeditor5-highlight/src/highlight.js';
import HorizontalLine from '@ckeditor/ckeditor5-horizontal-line/src/horizontalline.js';
import Image from '@ckeditor/ckeditor5-image/src/image.js';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption.js';
import ImageInsert from '@ckeditor/ckeditor5-image/src/imageinsert.js';
import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize.js';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle.js';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar.js';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload.js';
import ImportWord from '@ckeditor/ckeditor5-import-word/src/importword.js';
import Indent from '@ckeditor/ckeditor5-indent/src/indent.js';
import IndentBlock from '@ckeditor/ckeditor5-indent/src/indentblock.js';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic.js';
import Link from '@ckeditor/ckeditor5-link/src/link.js';
import LinkImage from '@ckeditor/ckeditor5-link/src/linkimage.js';
import MediaEmbed from '@ckeditor/ckeditor5-media-embed/src/mediaembed.js';
import MediaEmbedToolbar from '@ckeditor/ckeditor5-media-embed/src/mediaembedtoolbar.js';
import PageBreak from '@ckeditor/ckeditor5-page-break/src/pagebreak.js';
import Pagination from '@ckeditor/ckeditor5-pagination/src/pagination.js';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph.js';
import PasteFromOffice from '@ckeditor/ckeditor5-paste-from-office/src/pastefromoffice.js';
import PresenceList from '@ckeditor/ckeditor5-real-time-collaboration/src/presencelist.js';
import RealTimeCollaborativeComments from '@ckeditor/ckeditor5-real-time-collaboration/src/realtimecollaborativecomments.js';
import RealTimeCollaborativeEditing from '@ckeditor/ckeditor5-real-time-collaboration/src/realtimecollaborativeediting.js';
import RealTimeCollaborativeRevisionHistory from '@ckeditor/ckeditor5-real-time-collaboration/src/realtimecollaborativerevisionhistory.js';
import RemoveFormat from '@ckeditor/ckeditor5-remove-format/src/removeformat.js';
import SelectAll from '@ckeditor/ckeditor5-select-all/src/selectall.js';
import SpecialCharacters from '@ckeditor/ckeditor5-special-characters/src/specialcharacters.js';
import SpecialCharactersArrows from '@ckeditor/ckeditor5-special-characters/src/specialcharactersarrows.js';
import SpecialCharactersCurrency from '@ckeditor/ckeditor5-special-characters/src/specialcharacterscurrency.js';
import SpecialCharactersEssentials from '@ckeditor/ckeditor5-special-characters/src/specialcharactersessentials.js';
import SpecialCharactersMathematical from '@ckeditor/ckeditor5-special-characters/src/specialcharactersmathematical.js';
import SpecialCharactersText from '@ckeditor/ckeditor5-special-characters/src/specialcharacterstext.js';
import StandardEditingMode from '@ckeditor/ckeditor5-restricted-editing/src/standardeditingmode.js';
import Strikethrough from '@ckeditor/ckeditor5-basic-styles/src/strikethrough.js';
import Subscript from '@ckeditor/ckeditor5-basic-styles/src/subscript.js';
import Superscript from '@ckeditor/ckeditor5-basic-styles/src/superscript.js';
import Table from '@ckeditor/ckeditor5-table/src/table.js';
import TableCaption from '@ckeditor/ckeditor5-table/src/tablecaption.js';
import TableCellProperties from '@ckeditor/ckeditor5-table/src/tablecellproperties';
import TableColumnResize from '@ckeditor/ckeditor5-table/src/tablecolumnresize.js';
import TableOfContents from '@ckeditor/ckeditor5-document-outline/src/tableofcontents.js';
import TableProperties from '@ckeditor/ckeditor5-table/src/tableproperties';
import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar.js';
import Template from '@ckeditor/ckeditor5-template/src/template.js';
import TextPartLanguage from '@ckeditor/ckeditor5-language/src/textpartlanguage.js';
import TextTransformation from '@ckeditor/ckeditor5-typing/src/texttransformation.js';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline.js';
import WordCount from '@ckeditor/ckeditor5-word-count/src/wordcount.js';
import WProofreader from '@webspellchecker/wproofreader-ckeditor5/src/wproofreader.js';
import Comments from '@ckeditor/ckeditor5-comments/src/comments.js';
import RevisionHistory from '@ckeditor/ckeditor5-revision-history/src/revisionhistory.js';

class Editor extends DecoupledDocumentEditor {}

// Plugins to include in the build.
Editor.builtinPlugins = [
	Alignment,
	AutoImage,
	AutoLink,
	Bold,
	CloudServices,
	DataFilter,
	DocumentList,
	DocumentListProperties,
	EasyImage,
	Essentials,
	ExportPdf,
	ExportWord,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
	FormatPainter,
	GeneralHtmlSupport,
	Heading,
	Highlight,
	HorizontalLine,
	Image,
	ImageCaption,
	ImageInsert,
	ImageResize,
	ImageStyle,
	ImageToolbar,
	ImageUpload,
	ImportWord,
	Indent,
	IndentBlock,
	Italic,
	Link,
	LinkImage,
	MediaEmbed,
	MediaEmbedToolbar,
	PageBreak,
	Pagination,
	Paragraph,
	PasteFromOffice,
	PresenceList,
	RealTimeCollaborativeComments,
	RealTimeCollaborativeEditing,
	RealTimeCollaborativeRevisionHistory,
	RemoveFormat,
	SelectAll,
	SpecialCharacters,
	SpecialCharactersArrows,
	SpecialCharactersCurrency,
	SpecialCharactersEssentials,
	SpecialCharactersMathematical,
	SpecialCharactersText,
	StandardEditingMode,
	Strikethrough,
	Subscript,
	Superscript,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableOfContents,
	TableProperties,
	TableToolbar,
	Template,
	TextPartLanguage,
	TextTransformation,
	Underline,
	WordCount,
	WProofreader,
	Comments,
	RevisionHistory
];

// Editor configuration.
Editor.defaultConfig = {
	toolbar: {
		items: [
			'|',
			'selectAll',
			'importWord',
			'exportWord',
			'exportPdf',
			'|',
			'undo',
			'redo',
			'|',
			'restrictedEditingException',
			'revisionHistory',
			'|',
			'comment',
			'commentsArchive',
			'|',
			'-',
			'|',
			'bulletedList',
			'numberedList',
			'|',
			'indent',
			'outdent',
			'|',
			'tableOfContents',
			'insertTable',
			'specialCharacters',
			'insertTemplate',
			'|',
			'heading',
			'|',
			'imageUpload',
			'link',
			'imageInsert',
			'mediaEmbed',
			'|',
			'-',
			'|',
			'fontFamily',
			'fontSize',
			'|',
			'bold',
			'italic',
			'underline',
			'strikethrough',
			'subscript',
			'superscript',
			'|',
			'fontColor',
			'highlight',
			'fontBackgroundColor',
			'|',
			'alignment',
			'formatPainter',
			'|',
			'wproofreader',
			'removeFormat',
			'|',
			'-',
			'|',
			'pageNavigation',
			'|',
			'nextPage',
			'previousPage',
			'|',
			'horizontalLine',
			'pageBreak',
			'|'
		],
		shouldNotGroupWhenFull: true
	},
	language: 'es',
	image: {
		toolbar: [
			'imageTextAlternative',
			'toggleImageCaption',
			'imageStyle:inline',
			'imageStyle:block',
			'imageStyle:side',
			'linkImage',
			'comment',
			'comment'
		]
	},
	table: {
		contentToolbar: [
			'tableColumn',
			'tableRow',
			'mergeTableCells',
			'tableCellProperties',
			'tableProperties'
		],
		tableToolbar: [
			'comment',
			'comment'
		]
	},
	pagination: {
		pageWidth: '21cm',
		pageHeight: '29.7cm',
		pageMargins: {
			top: '20mm',
			bottom: '20mm',
			left: '12mm',
			right: '12mm'
		}
	},
	comments: {
		editorConfig: {
			extraPlugins: [
				Bold,
				Italic
			]
		}
	}
};

export default Editor;
