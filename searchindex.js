// search index for WYSIWYG Web Builder
var database_length = 0;

function SearchPage(url, title, keywords, description)
{
   this.url = url;
   this.title = title;
   this.keywords = keywords;
   this.description = description;
   return this;
}

function SearchDatabase()
{
   database_length = 0;
   this[database_length++] = new SearchPage("index.php", "Ratib-Film", "ratib film ji ber hisnataratib Şêxmûsغناء راتب شيخموس تصوير فريق للتصويرداخل الاستوديو احد الاعمال الخاصة بالفريق bella cawratib dîtinata mesûd sedar raman darî Şêxanîfilm ratip filmللمشاهدى على اليوتيوب شاهدها reşîd arıya azîz fehmîfilm roder zoya menhel silêman idrîs gulîstan xembar ebdêfilm ahmed rexda sebah hacofilm ulaş bihar kamanca xebat nicofilm efrîn Şêxmûsfilm logo no music تواصل معنا ratb emden phone01738544054 emailratip783 gmail com املئ الحقول copyright nbsp ratibfilm ", "");
   this[database_length++] = new SearchPage("succ.html", "صفحة بدون عنوان", "صفحة بدون عنوان تم ارسال الرسالة بنجاح ", "");
   this[database_length++] = new SearchPage("mob/index.php", "Ratib Film", "ratib film contact us lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio emden phone01738544054 emailratip783 gmail com nbsp ", "");
   this[database_length++] = new SearchPage("mob/contact_use.php", "صفحة بدون عنوان", "صفحة بدون عنوان ", "");
   return this;
}
