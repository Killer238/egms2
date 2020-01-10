<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => 'Changelog for SeoFilter.

1.7.0-beta (21.08.2019)
======================
- мелкие правки
- фикс ошибок при слешах в пседонимах
- sfLink теперь сам получает все правила для переданной id страницы
- добавил сниппет sfNearLink для вывода ближайшей хлебной крошки на странице товара (сильно бета)
- добавил чанк tpl.SeoFilter.crumbs.product для вставки в tplCurrent в pdoCrumbs на странице товара
- минимальная версия PHP 5.4 (была 5.3)

1.6.4-beta (17.03.2019)
======================
- поправлен класс sfMenu
- убраны предупреждения при установке/удалении компонента
- теперь устанавливается на MODX 3
- улучшено добавление default.js на страницу

1.6.3-beta (11.03.2019)
=======================
- добавлена поддержка одиночных значений для слайдера
- настройка seofilter_page_key теперь по умолчанию "page"
- добавлена настройка seofilter_page_tpl (шаблон для ЧПУ-пагинации, например "/[[+pageVarKey]]-[[+page]]")
- добавлена поддержка Ajax ЧПУ-пагинации в mFilter2

1.6.2-beta (01.02.2019)
=======================
- Добавлены ключи настроек во вкладку Настройки
- Поправлена работа с визуальным редактором CKEditor
- Исправление группировки по правилам для sfMenu в PRO-режиме
- Поправлена интеграция с FrontendManager

1.6.1-beta (22.01.2019)
=======================
- Обновление названия у SEO-страниц, если было пустым (при добавлении шаблона названия в правило)
- Автоматическое формирование шаблона названия, если он пуст (при добавлении полей в правило)
- Два новых условия LIKE, NOT LIKE при добавлении поля в правило
- Скрытая возможность менять url-маску в правилах (без проверок корректности)

1.6.0-beta (14.01.2019)
=======================
- Добавлено больше всплывающих описаний для полей, переименованы некоторые пункты
- Серьёзно переделан js-файл для фронтенда (старый с припиской -old)
- Возможность очень просто подгрузить контент и url под SEO-страницу из любого фильтра
- Добавлены события для плагинов при добавлении слов, ссылок и возвращению SEO-данных
- Возможность подключить визуальный редактор или Ace для любых полей в правиле/странице
- Новая вкладка Настройки для большего удобства
- Табы и гриды в админке теперь запоминают состояние
- Сортировка по активным объектам теперь по столбцу Действия
- Пошаговый пересчёт и удаление пустых страниц в SEO-страницах
- Условие для ограничения сбора значений в полях стало гораздо серьёзнее
- Вложенные хлебные крошки с автопоиском (чанк tpl.SeoFilter.crumbs.nested)
- Поддержка запросов с процентами, плюсами и амперсандами
- Возможность изменять путь класса для сниппетов
- Появились примеры заполненных полей при добавлении
- Улучшение подсчётов, исправление ошибок

1.5.4-beta (16.07.2018)
=======================
- Настройка seofilter_url_scheme по умолчанию "full";
- Новый параметр сниппета sfLink - "link_classes". Классы для ссылки;
- Слова теперь можно отключать и они не будут участвовать в формировании ссылок. Ссылки с ними - удалятся. Повторное включение создаст новые ссылки;
- Добавлен учёт настройки seofilter_admin_version, который отвечает за версионность скриптов в админке. Если версионность не нужна - добавьте настройку в ручную со значением 0;
- Поправлено формирование ссылок, адресов когда ссылки в один уровень и привязаны к главной;
- Поправлен подсчёт для слайдеров, если они на основе ТВ полей;
- Мелкие улучшения и переименования в админ-панели.

1.5.3-beta (19.06.2018)
=======================
- Небольшие изменения для подсчётов через расширение класса
- Неактивные поля теперь только для того, чтобы не собирать значения

1.5.2-beta (01.06.2018)
=======================
- Поправлен процессор вывода списка страниц
- Поправлена установка pdoTools при отсутствии на сайте

1.5.1-beta (24.05.2018)
=======================
- Поправлен сниппет sfLink для работы с Pro-режимом
- Поправлено поле editedon в mysql-схеме

1.5.0-beta (21.05.2018)
=======================
- Добавлен PRO-режим, который позволяет привязывать к правилу несколько страниц
- Интеграция с компонентом Tagger, включая подсчёты
- Добавлена возможность получать SEO-ссылки без вложенности через слеш (настройка seofilter_level_separator)
- Добавлена возможность генерации SEO-ссылок в 1 уровень от корня сайта (настройка seofilter_between_urls)
- Добавлен класс seoPage для переопределения класса pdoPage для получения более точных ссылок в пагинации
- Мелкие удобства с подсчётами:
- Локальный счётчик обновляется, если значения отличаются
- Новая настройка для подстановки условий в новые правила
- Добавлен файл для пересчёта через cron
- Новые поля по умолчанию в строгом поиске, так подсчёты гораздо точнее
- Добавлен пункт пересчёт результатов ссылок по слову и правилу в таблице через правую кнопку мыши
- Оптимизация и исправление всех предыдущих ошибок

1.4.8-beta (16.04.2018)
=======================
- Сниппет sfLink теперь принимает параметры pages, where, as_name для простоты поиска ссылок
- Поправил работу с группировкой в sfMenu, поддерживает сортировку правил, при пустом sortby сортировка согласно переданным правилам
- Сниппет sfWord вовзращает весь массив со всеми падежами для Fenom (можете использовать для склонения любых слов)
- В шаблон генерации ссылок добавлена переменная id ресурса {$id} для использования полей
- Добавлена настройка seofilter_replace_host (для тех сайтов, у которых одна страница доступна на нескольких доменах)
- Подчистил компонент от лишних записей в лог и исправил мелкие ошибки, оптимизировано под PHP 7.2

1.4.7-beta
==============
- Поправлен механизм поиска страницы в плагине для сайтов с дубликатами синонимов
- Поправлена работа с parents в sfMenu, теперь строго "page:IN" (без OR)

1.4.6-beta
==============
- Поправил ошибку в плагине при отключенных подсчётах

1.4.5-beta
==============
- Добавил забытый where для sfMenu
- Добавлена поддержка PHP 5.3

1.4.4-beta
==============
- Повышена стабильность работы
- Больше "связанных" функций
- Исправлено множество ошибок
- Добавлена зависимость полей
- Исправлены подсчёты
- Для подсчётов добавлен новый класс, который можно расширять
- Интеграция tvSuperSelect - указать компонент в Поле
- Обрабатываются замороженные адресов страниц
- Поправлено формирование ссылок
- Учитываются различный суффиксы контейнером
- Перегенерация названий ссылок при изменении слова
- Промежуточные подсчёты для ускорения меню
- Пересчёт результатов при изменениях или по кнопке
- Улучшено копирование правила
- Добавление правила за один подход
- Ajax хлебные крошки
- Добавлено поле keywords в правила и ссылки
- Передача параметра LastModified (настройка)
- Поддержка браузерной истории по кнопкам назад, вперёд
- Версионнирование js,css файлов
- Обновления в склонениях. Теперь нужен только токен.
- Интеграция с msVendorCollections
- Добавлены скрытые возможности
- Мелкие улучшения в работе


1.3.1-beta
==============
- Мелкие исправления по ТВ-полям
- Убрал забытый из меню вывод в лог
- Изменён поиск пути в action.php

1.3.0-beta
==============
- Добавлен сниппет sfMenu для формирования меню с подсчётом ресурсов
- Добавлен сниппет sfSitemap для формирования карты сайта
- Полностью переработан сниппет sfLink - гораздо быстрее и удобнее
- Поправил работу плагина с вложенностью страниц
- Добавлен новый класс для работы с меню

1.2.2-beta
==============
- Добавлена поддержка JSON полей, включая tvSuperSelect
- Изменён приоритет на событие onDocFormSave для поддержки TVSS
- Добавлена работа с любыми суффиксами контейнера (/,.html и т.д)
- Добавлена настройка для добавления своего суффикса к сгенерированным страницам
- Добавлена настройка переадресации на правильный суффикс
- Добавлена настройка с названием параметра пагинации, для передачи № страницы в СЕО тексты

1.2.1-beta
==============
- Добавлена поддержка значений из других таблиц для ТВ полей

1.2.0-beta
==============
- Добавлена работа для работы полей-слайдеров (недорогие товары и т.д)
- Устранены некоторые ошибки в js и в классе
- Автоматическая генерация названия для новых ссылок при добавлении новых слов
- Лексиконы компонента переведены на английский язык
- Убраны из класса значения по-умолчанию, чтобы не было подстановок на пустых js полях

1.1.3-beta
==============
- Добавлено копирование правил
- Шаблоны для названия ссылки и галочка перегенерировать
- Изменён механизм подсчёта потомков и выборок
- Добавление правил с учётом полей-слайдеров (цена и т.д)
- Две новые настройки для названия ссылки

1.1.2-beta
==============
- Поправлена работа с ТВ-полями

1.1.1-beta
==============
- Соседние вкладки теперь обновляются автоматически
- Мелкие фиксы

1.1.0-beta
==============
- Поправлены лексиконы
- Поправлен js-файл для обработки заголовков
- Убраны лишние комментарии
- Устанены мелкие баги и ошибки

1.0.10-beta
==============
- Добавлены условия для полей в правиле, чтобы создавать определённые страницы
- Добавил поле editedon для правила и комбобокс с выбором страницы
- Поправил подсчёт мин/макс выборок по ТВ значениям
- Мощный апгрейд кода в логике поиска правил, приоритеты для правил
- Добавлен сниппет sfLink для создания ссылки по нескольким правилам

1.0.9-beta
==============
- Новые комбобоксы в словаре, по полю и значению для более быстрого поиска нужных адресов

1.0.8-beta
==============
- Добавил столбик с датой редактирования для словаря

1.0.7-beta
==============
- Вернул добавление слова в словарь, так удобнее
- Сделал нормальную 404-ую страницу при несуществующих страницах (из админки можно проверить страницу по get-параметрам)

1.0.6-beta
==============
- Вывел для редактирования в окнах URL пункты, связанные с выводом меню

1.0.5-beta
==============
- Добавлен контроллёр для редактирования уникальных мета-тегов с фронтенда для каждой страницы
- Добавлена новый класс для связи URL с полями и словами
- Теперь после редактирования поля, слова обновляются все связанные данные

1.0.4-beta
==============
- Добавил функцию выборки минимальных и максимальных значений.
- Добавил prepareSnippet для подстановки обработанных значений в мета-теги

1.0.3-beta
==============
- Исправление ошибок
- Добавил функцию подсчёта. Активировать в настройках. В шаблонах плейсхолдер count

1.0.2-beta
==============
- Конкретно переписана логика компонента

1.0.1-beta
==============
- Добавлена работа со всеми полями

1.0.0-beta
==============
- First Release',
    'license' => 'GNU GENERAL PUBLIC LICENSE
   Version 2, June 1991
--------------------------

Copyright (C) 1989, 1991 Free Software Foundation, Inc.
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Everyone is permitted to copy and distribute verbatim copies
of this license document, but changing it is not allowed.

Preamble
--------

  The licenses for most software are designed to take away your
freedom to share and change it.  By contrast, the GNU General Public
License is intended to guarantee your freedom to share and change free
software--to make sure the software is free for all its users.  This
General Public License applies to most of the Free Software
Foundation\'s software and to any other program whose authors commit to
using it.  (Some other Free Software Foundation software is covered by
the GNU Library General Public License instead.)  You can apply it to
your programs, too.

  When we speak of free software, we are referring to freedom, not
price.  Our General Public Licenses are designed to make sure that you
have the freedom to distribute copies of free software (and charge for
this service if you wish), that you receive source code or can get it
if you want it, that you can change the software or use pieces of it
in new free programs; and that you know you can do these things.

  To protect your rights, we need to make restrictions that forbid
anyone to deny you these rights or to ask you to surrender the rights.
These restrictions translate to certain responsibilities for you if you
distribute copies of the software, or if you modify it.

  For example, if you distribute copies of such a program, whether
gratis or for a fee, you must give the recipients all the rights that
you have.  You must make sure that they, too, receive or can get the
source code.  And you must show them these terms so they know their
rights.

  We protect your rights with two steps: (1) copyright the software, and
(2) offer you this license which gives you legal permission to copy,
distribute and/or modify the software.

  Also, for each author\'s protection and ours, we want to make certain
that everyone understands that there is no warranty for this free
software.  If the software is modified by someone else and passed on, we
want its recipients to know that what they have is not the original, so
that any problems introduced by others will not reflect on the original
authors\' reputations.

  Finally, any free program is threatened constantly by software
patents.  We wish to avoid the danger that redistributors of a free
program will individually obtain patent licenses, in effect making the
program proprietary.  To prevent this, we have made it clear that any
patent must be licensed for everyone\'s free use or not licensed at all.

  The precise terms and conditions for copying, distribution and
modification follow.


GNU GENERAL PUBLIC LICENSE
TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
---------------------------------------------------------------

  0. This License applies to any program or other work which contains
a notice placed by the copyright holder saying it may be distributed
under the terms of this General Public License.  The "Program", below,
refers to any such program or work, and a "work based on the Program"
means either the Program or any derivative work under copyright law:
that is to say, a work containing the Program or a portion of it,
either verbatim or with modifications and/or translated into another
language.  (Hereinafter, translation is included without limitation in
the term "modification".)  Each licensee is addressed as "you".

Activities other than copying, distribution and modification are not
covered by this License; they are outside its scope.  The act of
running the Program is not restricted, and the output from the Program
is covered only if its contents constitute a work based on the
Program (independent of having been made by running the Program).
Whether that is true depends on what the Program does.

  1. You may copy and distribute verbatim copies of the Program\'s
source code as you receive it, in any medium, provided that you
conspicuously and appropriately publish on each copy an appropriate
copyright notice and disclaimer of warranty; keep intact all the
notices that refer to this License and to the absence of any warranty;
and give any other recipients of the Program a copy of this License
along with the Program.

You may charge a fee for the physical act of transferring a copy, and
you may at your option offer warranty protection in exchange for a fee.

  2. You may modify your copy or copies of the Program or any portion
of it, thus forming a work based on the Program, and copy and
distribute such modifications or work under the terms of Section 1
above, provided that you also meet all of these conditions:

    a) You must cause the modified files to carry prominent notices
    stating that you changed the files and the date of any change.

    b) You must cause any work that you distribute or publish, that in
    whole or in part contains or is derived from the Program or any
    part thereof, to be licensed as a whole at no charge to all third
    parties under the terms of this License.

    c) If the modified program normally reads commands interactively
    when run, you must cause it, when started running for such
    interactive use in the most ordinary way, to print or display an
    announcement including an appropriate copyright notice and a
    notice that there is no warranty (or else, saying that you provide
    a warranty) and that users may redistribute the program under
    these conditions, and telling the user how to view a copy of this
    License.  (Exception: if the Program itself is interactive but
    does not normally print such an announcement, your work based on
    the Program is not required to print an announcement.)

These requirements apply to the modified work as a whole.  If
identifiable sections of that work are not derived from the Program,
and can be reasonably considered independent and separate works in
themselves, then this License, and its terms, do not apply to those
sections when you distribute them as separate works.  But when you
distribute the same sections as part of a whole which is a work based
on the Program, the distribution of the whole must be on the terms of
this License, whose permissions for other licensees extend to the
entire whole, and thus to each and every part regardless of who wrote it.

Thus, it is not the intent of this section to claim rights or contest
your rights to work written entirely by you; rather, the intent is to
exercise the right to control the distribution of derivative or
collective works based on the Program.

In addition, mere aggregation of another work not based on the Program
with the Program (or with a work based on the Program) on a volume of
a storage or distribution medium does not bring the other work under
the scope of this License.

  3. You may copy and distribute the Program (or a work based on it,
under Section 2) in object code or executable form under the terms of
Sections 1 and 2 above provided that you also do one of the following:

    a) Accompany it with the complete corresponding machine-readable
    source code, which must be distributed under the terms of Sections
    1 and 2 above on a medium customarily used for software interchange; or,

    b) Accompany it with a written offer, valid for at least three
    years, to give any third party, for a charge no more than your
    cost of physically performing source distribution, a complete
    machine-readable copy of the corresponding source code, to be
    distributed under the terms of Sections 1 and 2 above on a medium
    customarily used for software interchange; or,

    c) Accompany it with the information you received as to the offer
    to distribute corresponding source code.  (This alternative is
    allowed only for noncommercial distribution and only if you
    received the program in object code or executable form with such
    an offer, in accord with Subsection b above.)

The source code for a work means the preferred form of the work for
making modifications to it.  For an executable work, complete source
code means all the source code for all modules it contains, plus any
associated interface definition files, plus the scripts used to
control compilation and installation of the executable.  However, as a
special exception, the source code distributed need not include
anything that is normally distributed (in either source or binary
form) with the major components (compiler, kernel, and so on) of the
operating system on which the executable runs, unless that component
itself accompanies the executable.

If distribution of executable or object code is made by offering
access to copy from a designated place, then offering equivalent
access to copy the source code from the same place counts as
distribution of the source code, even though third parties are not
compelled to copy the source along with the object code.

  4. You may not copy, modify, sublicense, or distribute the Program
except as expressly provided under this License.  Any attempt
otherwise to copy, modify, sublicense or distribute the Program is
void, and will automatically terminate your rights under this License.
However, parties who have received copies, or rights, from you under
this License will not have their licenses terminated so long as such
parties remain in full compliance.

  5. You are not required to accept this License, since you have not
signed it.  However, nothing else grants you permission to modify or
distribute the Program or its derivative works.  These actions are
prohibited by law if you do not accept this License.  Therefore, by
modifying or distributing the Program (or any work based on the
Program), you indicate your acceptance of this License to do so, and
all its terms and conditions for copying, distributing or modifying
the Program or works based on it.

  6. Each time you redistribute the Program (or any work based on the
Program), the recipient automatically receives a license from the
original licensor to copy, distribute or modify the Program subject to
these terms and conditions.  You may not impose any further
restrictions on the recipients\' exercise of the rights granted herein.
You are not responsible for enforcing compliance by third parties to
this License.

  7. If, as a consequence of a court judgment or allegation of patent
infringement or for any other reason (not limited to patent issues),
conditions are imposed on you (whether by court order, agreement or
otherwise) that contradict the conditions of this License, they do not
excuse you from the conditions of this License.  If you cannot
distribute so as to satisfy simultaneously your obligations under this
License and any other pertinent obligations, then as a consequence you
may not distribute the Program at all.  For example, if a patent
license would not permit royalty-free redistribution of the Program by
all those who receive copies directly or indirectly through you, then
the only way you could satisfy both it and this License would be to
refrain entirely from distribution of the Program.

If any portion of this section is held invalid or unenforceable under
any particular circumstance, the balance of the section is intended to
apply and the section as a whole is intended to apply in other
circumstances.

It is not the purpose of this section to induce you to infringe any
patents or other property right claims or to contest validity of any
such claims; this section has the sole purpose of protecting the
integrity of the free software distribution system, which is
implemented by public license practices.  Many people have made
generous contributions to the wide range of software distributed
through that system in reliance on consistent application of that
system; it is up to the author/donor to decide if he or she is willing
to distribute software through any other system and a licensee cannot
impose that choice.

This section is intended to make thoroughly clear what is believed to
be a consequence of the rest of this License.

  8. If the distribution and/or use of the Program is restricted in
certain countries either by patents or by copyrighted interfaces, the
original copyright holder who places the Program under this License
may add an explicit geographical distribution limitation excluding
those countries, so that distribution is permitted only in or among
countries not thus excluded.  In such case, this License incorporates
the limitation as if written in the body of this License.

  9. The Free Software Foundation may publish revised and/or new versions
of the General Public License from time to time.  Such new versions will
be similar in spirit to the present version, but may differ in detail to
address new problems or concerns.

Each version is given a distinguishing version number.  If the Program
specifies a version number of this License which applies to it and "any
later version", you have the option of following the terms and conditions
either of that version or of any later version published by the Free
Software Foundation.  If the Program does not specify a version number of
this License, you may choose any version ever published by the Free Software
Foundation.

  10. If you wish to incorporate parts of the Program into other free
programs whose distribution conditions are different, write to the author
to ask for permission.  For software which is copyrighted by the Free
Software Foundation, write to the Free Software Foundation; we sometimes
make exceptions for this.  Our decision will be guided by the two goals
of preserving the free status of all derivatives of our free software and
of promoting the sharing and reuse of software generally.

NO WARRANTY
-----------

  11. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY
FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN
OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED
OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS
TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE
PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING,
REPAIR OR CORRECTION.

  12. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR
REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES,
INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING
OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED
TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY
YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER
PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE
POSSIBILITY OF SUCH DAMAGES.

---------------------------
END OF TERMS AND CONDITIONS',
    'readme' => '--------------------
SeoFilter - convenient control of friendly URL, meta tags and text generation
--------------------
Author: Evgeniy Sheronov <webrush@bk.ru>
--------------------

SeoFilter for Minishop2 & mSearch2 and not only for MODX Revolution.

The articles about SeoFilter:
https://modx.pro/components/12921/
https://modx.pro/components/13407/
https://modx.pro/components/14899/
https://modx.pro/components/15476/
https://modx.pro/components/17313/

Full Documentation: https://docs.modx.pro/komponentyi/seofilter
Demo: http://s9767.h8.modhost.pro

Possible additional paid modifications for a specific project.',
    'chunks' => 
    array (
      'tpl.SeoFilter.crumbs.current' => '{if !$sflink}{set $sflink = $_modx->getPlaceholder(\'sf.link\')}{/if}
{if !$sfurl}{set $sfurl = $_modx->getPlaceholder(\'sf.url\')}{/if}
<li class="sf_crumb{if !$sflink} active{/if}" data-idx="{$idx}" data-separator="{$outputSeparator|htmlentities}">
    {if $sflink}
        <a href="{$link}">{$menutitle}</a>
    {else}
        {$menutitle}
    {/if}
</li>{if $sflink}{$outputSeparator}<li class="active sf_crumbs" data-idx="{++$idx}">
<span class="sf_link">{$sflink}</span>
    {*закомментированный ниже вариант позволит возвращать ссылку *}
    {*{set $page_link = $link}
    {foreach [\'.html\',\'.php\'] as $suffix}
        {set $msufx = \'*\'~$suffix}
        {if $page_link | match : $msufx}
            {set $r_mask = \'/\'~$suffix~\'$/\'}
            {set $page_link = ($page_link | ereplace: $r_mask:\'/\')}
            {break}
        {/if}
    {/foreach}
    <a href="{$page_link}{$sfurl}" class="sf_link">{$sflink}</a>
    *}
</li>
{/if}
',
      'tpl.SeoFilter.crumbs.nested' => '{if !$sfnested}{set $sfnested = $_modx->getPlaceholder(\'sf.nested\')|fromJSON}{/if}
{if !$sflink}{set $sflink = $_modx->getPlaceholder(\'sf.link\')}{/if}
{if !$sfurl}{set $sfurl = $_modx->getPlaceholder(\'sf.url\')}{/if}
{if !$idx}{set $idx = 1}{/if}
{set $page_link = $link}
{foreach [\'.html\',\'.php\'] as $suffix}
    {set $msufx = \'*\'~$suffix}
    {if $page_link | match : $msufx}
        {set $r_mask = \'/\'~$suffix~\'$/\'}
        {set $page_link = ($page_link | ereplace: $r_mask:\'/\')}
        {break}
    {/if}
{/foreach}
<li class="sf_crumb{if !$sflink} active{/if}" data-idx="{$idx++}" data-separator="{$outputSeparator|htmlentities}">{if $sflink}<a href="{$link}">{$menutitle}</a>{else}{$menutitle}{/if}
</li>{if $sfnested?}{foreach $sfnested as $inner_link}{$outputSeparator}<li class="sf_crumb_nested" data-idx="{$idx++}"><a href="{$page_link}{$inner_link[\'sfurl\']}">{$inner_link[\'sflink\']}</a>
</li>{/foreach}{/if}{if $sflink}{$outputSeparator}<li class="active sf_crumbs" data-idx="{$idx++}"><span class="sf_link">{$sflink}</span>
    {*закомментированный ниже вариант позволит возвращать ссылку *}
    {*<a href="{$page_link}{$sfurl}" class="sf_link">{$sflink}</a>*}
</li>{/if}
',
      'tpl.SeoFilter.crumbs.product' => '{$_modx->runSnippet(\'sfNearLink\',[
    \'outputSeparator\' => $outputSeparator,
    \'tpl\'=>\'@INLINE <li><a href="{$url}">{$name}</a></li>\'
])}
<li class="active">{$menutitle}</li>',
    ),
    'setup-options' => 'seofilter-1.7.0-beta/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'b0d3e32c28a4934a868ef10c2e98cdf1',
      'native_key' => 'seofilter',
      'filename' => 'modNamespace/2ea8126262edac5ad328acb1aea72e82.vehicle',
      'namespace' => 'seofilter',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '59640bc27412d7d9bcc8062bb2b21940',
      'native_key' => '59640bc27412d7d9bcc8062bb2b21940',
      'filename' => 'xPDOFileVehicle/622ecfe9781a761e49d3b2c699d45b25.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9d1c281570f8ce185691355a459830f3',
      'native_key' => 'seofilter_separator',
      'filename' => 'modSystemSetting/4346dc5d07d7022fff05fed0542c3142.vehicle',
      'namespace' => 'seofilter',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd1ae585f1567df0a4ee5cebeaf5357b6',
      'native_key' => 'seofilter_base_get',
      'filename' => 'modSystemSetting/80c345869fa38273f9b05ad0613fe6c9.vehicle',
      'namespace' => 'seofilter',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '52f56e4c286c59c699ada10164ea9344',
      'native_key' => 'seofilter_ajax',
      'filename' => 'modSystemSetting/c9310073e83a9144d0b83ece9eeb12db.vehicle',
      'namespace' => 'seofilter',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4b9a5d3aa244bf1cf199ac270c843fba',
      'native_key' => 'seofilter_decline',
      'filename' => 'modSystemSetting/40dd7dbc46bb118cc3b414a3ccd612d5.vehicle',
      'namespace' => 'seofilter',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e965b838b162c83f03e684c99dc05508',
      'native_key' => 'seofilter_morpher_token',
      'filename' => 'modSystemSetting/eac1b9f4e8e53cde724eae9eecadb182.vehicle',
      'namespace' => 'seofilter',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5ae905970ba57e14a6f04597e7618e14',
      'native_key' => 'seofilter_classes',
      'filename' => 'modSystemSetting/291b4022c37334807d7395e9d297ddd0.vehicle',
      'namespace' => 'seofilter',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c39ee7b0ec97977f9b050916e5b453f4',
      'native_key' => 'seofilter_templates',
      'filename' => 'modSystemSetting/55ad8c012f0d8e47eae553df71ca8cd2.vehicle',
      'namespace' => 'seofilter',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '484307c87ec8e61531c33321f28a21a8',
      'native_key' => 'seofilter_page_key',
      'filename' => 'modSystemSetting/f04753aa5cd54e18e1376c8a64cb52be.vehicle',
      'namespace' => 'seofilter',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ff6f7214414cb5ea5909937b814e677e',
      'native_key' => 'seofilter_page_tpl',
      'filename' => 'modSystemSetting/6b28fabad86f077390c37765794121b9.vehicle',
      'namespace' => 'seofilter',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bf10f09262554edaa14bc289c50d3801',
      'native_key' => 'seofilter_url_suffix',
      'filename' => 'modSystemSetting/c964e701a69afad44c09bfaac5b0b424.vehicle',
      'namespace' => 'seofilter',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '98eecb4af294fb0eb551ebabe026d5c5',
      'native_key' => 'seofilter_url_redirect',
      'filename' => 'modSystemSetting/d9d8a3459e87f2496a432cf54f3f19f0.vehicle',
      'namespace' => 'seofilter',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7c87cfb2c785c888e33dfd2103b5abf3',
      'native_key' => 'seofilter_last_modified',
      'filename' => 'modSystemSetting/2ebc6d47890e8562236de7af06e778a7.vehicle',
      'namespace' => 'seofilter',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3c8144e23bc42e830e3147454ca98daa',
      'native_key' => 'seofilter_mfilter_words',
      'filename' => 'modSystemSetting/0d514d1d4014608bf4328dc0f5bd7a5f.vehicle',
      'namespace' => 'seofilter',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '901125927d7d8babae33b2f5aadaefd1',
      'native_key' => 'seofilter_values_separator',
      'filename' => 'modSystemSetting/17d0ce9cda734b4c3336621ab44f6013.vehicle',
      'namespace' => 'seofilter',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '986f1750c981332b3238a4326dbe7a66',
      'native_key' => 'seofilter_values_delimeter',
      'filename' => 'modSystemSetting/decda455c9ca0b6550ab624c2e0f8725.vehicle',
      'namespace' => 'seofilter',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4d81e228507ab32cee180d4426fe1cfb',
      'native_key' => 'seofilter_snippet',
      'filename' => 'modSystemSetting/f56dd20643b2ae0bf8e0793855149547.vehicle',
      'namespace' => 'seofilter',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '54730347f1305e81ca643048b8480ca6',
      'native_key' => 'seofilter_replace_host',
      'filename' => 'modSystemSetting/909990b54a21144d0568f43cf96aee6b.vehicle',
      'namespace' => 'seofilter',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e6b409d608a6fe2c0945bc91c61c4632',
      'native_key' => 'seofilter_pro_mode',
      'filename' => 'modSystemSetting/9adeb5961573885b76cede977b766e04.vehicle',
      'namespace' => 'seofilter',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '58703ba453039390622fb97d742677db',
      'native_key' => 'seofilter_url_scheme',
      'filename' => 'modSystemSetting/cb323e7713268a8cb58f5af051ba6e1e.vehicle',
      'namespace' => 'seofilter',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0ed90d21c1bfee4a8929a36097256fd5',
      'native_key' => 'seofilter_level_separator',
      'filename' => 'modSystemSetting/b7187ce74948aa02bc2c8338c7122255.vehicle',
      'namespace' => 'seofilter',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd15f1f0ce6e5a3337a59694bc1daf134',
      'native_key' => 'seofilter_between_urls',
      'filename' => 'modSystemSetting/8b7e2793ba74dc3ae9bf9b04d0e1a7be.vehicle',
      'namespace' => 'seofilter',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f1ae9bbb4a5fa2f76e28ef98bb196fa0',
      'native_key' => 'seofilter_main_alias',
      'filename' => 'modSystemSetting/fd656e5f30865a0d5af2d0748b48837d.vehicle',
      'namespace' => 'seofilter',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '211a815154c962c32ff6b75c03072793',
      'native_key' => 'seofilter_admin_version',
      'filename' => 'modSystemSetting/a200b6c4fee9a706cdcbdd913e84f12e.vehicle',
      'namespace' => 'seofilter',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'df1920131b058ba513c92500755fd21d',
      'native_key' => 'seofilter_collect_words',
      'filename' => 'modSystemSetting/c0719f96ee389dd5010d0b744f3f4bbb.vehicle',
      'namespace' => 'seofilter',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '94c2162ff88eabc9622aa93d45daa0c7',
      'native_key' => 'seofilter_content_richtext',
      'filename' => 'modSystemSetting/975d088d41e26bc9758893f1014275fe.vehicle',
      'namespace' => 'seofilter',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '946f461d4d982dbea060f0a260eb8703',
      'native_key' => 'seofilter_content_ace',
      'filename' => 'modSystemSetting/c4656e10054393136f936a52fe1104c9.vehicle',
      'namespace' => 'seofilter',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6e3295afe7eb45ffd7cc780c81930846',
      'native_key' => 'seofilter_frontend_js',
      'filename' => 'modSystemSetting/0ee56892c542b594a3691ce2ef76463b.vehicle',
      'namespace' => 'seofilter',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1c35f7172696cd36cd4264c0f524eecd',
      'native_key' => 'seofilter_hide_empty',
      'filename' => 'modSystemSetting/b319ef1657f3772e19d00a1357f05918.vehicle',
      'namespace' => 'seofilter',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3859b50821a155bc40507bae4f9ff730',
      'native_key' => 'seofilter_count',
      'filename' => 'modSystemSetting/5da6e866a7e6d3368d78e0cbce435f46.vehicle',
      'namespace' => 'seofilter',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '276950cefb6c16b4060a7b25e44846f4',
      'native_key' => 'seofilter_choose',
      'filename' => 'modSystemSetting/d7635a16e6ee4340ff5cf3d73dfa4da5.vehicle',
      'namespace' => 'seofilter',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6f123509b70b0990d3a9de1954ea821f',
      'native_key' => 'seofilter_count_handler_class',
      'filename' => 'modSystemSetting/fb3e211fa908da2993a1331283facef8.vehicle',
      'namespace' => 'seofilter',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a86f81ae213c7af8135be5bf72bc0fde',
      'native_key' => 'seofilter_select',
      'filename' => 'modSystemSetting/cae83122e74688cc123feae421fce250.vehicle',
      'namespace' => 'seofilter',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fde54553e03ef98ecb673314ec91649b',
      'native_key' => 'seofilter_default_where',
      'filename' => 'modSystemSetting/aec8985a669c7068d05b3a22381f3571.vehicle',
      'namespace' => 'seofilter',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '98e4fc4432779519514f49662715bfb4',
      'native_key' => 'seofilter_title',
      'filename' => 'modSystemSetting/e212873b1ec8ffd194d4956429e2afbb.vehicle',
      'namespace' => 'seofilter',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2b5ffaacb02dd24139a6836363ee2178',
      'native_key' => 'seofilter_description',
      'filename' => 'modSystemSetting/dc700d89e8123fad4f8060d52910cf4b.vehicle',
      'namespace' => 'seofilter',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '885e3c8ee44000cac93754438c84f1a5',
      'native_key' => 'seofilter_introtext',
      'filename' => 'modSystemSetting/41b46a041000bb038eefa640c3ede2ac.vehicle',
      'namespace' => 'seofilter',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0ffdb25319ebe16592931279e8c87c0d',
      'native_key' => 'seofilter_keywords',
      'filename' => 'modSystemSetting/09ca8ccd851d1caae8d26ce5c893bf52.vehicle',
      'namespace' => 'seofilter',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7424b3e3a12eff864d4da3d094c6f9a9',
      'native_key' => 'seofilter_link',
      'filename' => 'modSystemSetting/2f5ca71fe912ea77b5cbe0996f910050.vehicle',
      'namespace' => 'seofilter',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bb5232815a8534cad1f6353b9dcbcbe5',
      'native_key' => 'seofilter_h1',
      'filename' => 'modSystemSetting/691482165fe6e82fc9b1c6f32efbaedf.vehicle',
      'namespace' => 'seofilter',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '323a8131e666d3350c8638d202b9f4b7',
      'native_key' => 'seofilter_h2',
      'filename' => 'modSystemSetting/5da115e4c1f6b9c1f264e9a8287c30ed.vehicle',
      'namespace' => 'seofilter',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '49188b83cea8ae0b7659dff6390a5807',
      'native_key' => 'seofilter_text',
      'filename' => 'modSystemSetting/a19fda6e62aecfd34439f2b3f0090453.vehicle',
      'namespace' => 'seofilter',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6dd5e6a38d75a8a36ee919f73849a8a0',
      'native_key' => 'seofilter_content',
      'filename' => 'modSystemSetting/dddf5a1b6cf1e5b8261943e692c86305.vehicle',
      'namespace' => 'seofilter',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6960bd1b4efeb88189585cfbf44866ac',
      'native_key' => 'seofilter_crumbs_tpl_current',
      'filename' => 'modSystemSetting/b87d94710ebd7495ed7e35592a6b690e.vehicle',
      'namespace' => 'seofilter',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1faea7a8e0837127050019df8988760b',
      'native_key' => 'seofilter_replacebefore',
      'filename' => 'modSystemSetting/f62fd36d9ab56e425213d0be55f8ddaa.vehicle',
      'namespace' => 'seofilter',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c2a012b3e6c84bc5db71dc53e966816b',
      'native_key' => 'seofilter_replaceseparator',
      'filename' => 'modSystemSetting/c1ee7c1db0c72ae3607f23bff5f1fc58.vehicle',
      'namespace' => 'seofilter',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ef7b44b85e1248f9d0fdd58608e97a4d',
      'native_key' => 'seofilter_jtitle',
      'filename' => 'modSystemSetting/327314f83940756073629e22f3765c65.vehicle',
      'namespace' => 'seofilter',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '01b3cc7fb05e5ce4caccea9bae1b8afe',
      'native_key' => 'seofilter_jdescription',
      'filename' => 'modSystemSetting/b891953f7650378603ee9426d5f1ff8a.vehicle',
      'namespace' => 'seofilter',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a9908220f152cdb149977a275e3a1391',
      'native_key' => 'seofilter_jintrotext',
      'filename' => 'modSystemSetting/7ecd984274ec2f0bd9dc378546eb518a.vehicle',
      'namespace' => 'seofilter',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7f896564575638b4887634a916595e53',
      'native_key' => 'seofilter_jkeywords',
      'filename' => 'modSystemSetting/27e56e5971af1c01106263af3efbcd3f.vehicle',
      'namespace' => 'seofilter',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8290894c8275ecf29c7800ab593f0811',
      'native_key' => 'seofilter_jlink',
      'filename' => 'modSystemSetting/86ede0d56b05fd15118653fc3c7ef39a.vehicle',
      'namespace' => 'seofilter',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '84b9882a03bb3f5fcc21426114cb31ac',
      'native_key' => 'seofilter_jh1',
      'filename' => 'modSystemSetting/2de32f4efef941eb0e5c960076b3d031.vehicle',
      'namespace' => 'seofilter',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '93acab705785a0a3b95fbc9bccdbd874',
      'native_key' => 'seofilter_jh2',
      'filename' => 'modSystemSetting/58737c83c6357bb5f8e0fe1799743db4.vehicle',
      'namespace' => 'seofilter',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bc58a54326fb68701dea6f1156eed624',
      'native_key' => 'seofilter_jtext',
      'filename' => 'modSystemSetting/27150046131ed32af0699e4cf0aec567.vehicle',
      'namespace' => 'seofilter',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9cc156663fda9801593815d024d9f268',
      'native_key' => 'seofilter_jcontent',
      'filename' => 'modSystemSetting/a1b44354b354f2417b2030f392ffc566.vehicle',
      'namespace' => 'seofilter',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2d203c94b37fa8e0ef26a99575a885b4',
      'native_key' => 'seofilter_crumbs_replace',
      'filename' => 'modSystemSetting/0fd90377ad178038c8bf5cc4051f5c61.vehicle',
      'namespace' => 'seofilter',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dd43a3745c63f141fb8aff4d3ca0c538',
      'native_key' => 'seofilter_crumbs_nested',
      'filename' => 'modSystemSetting/c718ba7b05f81b8952904da09c2b7352.vehicle',
      'namespace' => 'seofilter',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '5e52bc70da29987a77d13e710ac46816',
      'native_key' => 'sfOnBeforeWordAdd',
      'filename' => 'modEvent/47f59c64bb1f581133aa46001bbf6268.vehicle',
      'namespace' => 'seofilter',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1d77883a10edd8dd9e3c64b31ba1110c',
      'native_key' => 'sfOnWordAdd',
      'filename' => 'modEvent/89c01b86dd6aa7d0db620b4e407734f5.vehicle',
      'namespace' => 'seofilter',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '6c0f606f3548234f6e7fae053d7a373b',
      'native_key' => 'sfOnBeforeUrlAdd',
      'filename' => 'modEvent/d55baf6d04f18991616856eb53f0e49d.vehicle',
      'namespace' => 'seofilter',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'f86eda699e74abfa08d73e3da38b6063',
      'native_key' => 'sfOnUrlAdd',
      'filename' => 'modEvent/4a1742cfefbb17a8170d1bb7e3ea4fc1.vehicle',
      'namespace' => 'seofilter',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '00ffdb7fcba1436af47d8eaab19afd69',
      'native_key' => 'sfOnReturnMeta',
      'filename' => 'modEvent/58e8725d8159f5702219d1efb17263d4.vehicle',
      'namespace' => 'seofilter',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'e5407d5791f8466f5c5b17e700db8a87',
      'native_key' => 'seofilter',
      'filename' => 'modMenu/f1d3fa26ebb988329ea3afed998fe391.vehicle',
      'namespace' => 'seofilter',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'encryptedVehicle',
      'class' => 'modCategory',
      'guid' => 'fd09f5fa91d9e10037e72bb24ef88d89',
      'native_key' => NULL,
      'filename' => 'modCategory/6728fad877ab26f65af8292b326ad559.vehicle',
      'namespace' => 'seofilter',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '6852f1fb80e4a1c1f19c4cf11e919aa5',
      'native_key' => '6852f1fb80e4a1c1f19c4cf11e919aa5',
      'filename' => 'xPDOScriptVehicle/2a2d74ff7f82ec7497690228aeea9cd0.vehicle',
      'namespace' => 'seofilter',
    ),
  ),
);