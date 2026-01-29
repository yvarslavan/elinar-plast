document.addEventListener('DOMContentLoaded', function () {
  setupPDFDownload('btn-download-requirements-pvc', 'Technical_Requirements_PVC.pdf', getPVCContent());
  setupPDFDownload('btn-download-spec-chamfer', 'Specification_Chamfer_Strips.pdf', getChamferContent());
});

function setupPDFDownload(buttonId, filename, contentHTML) {
  const btn = document.getElementById(buttonId);
  if (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      const originalContent = btn.innerHTML;

      btn.innerHTML = 'Подготовка файла...';
      btn.style.opacity = '0.7';
      btn.style.cursor = 'wait';
      btn.style.pointerEvents = 'none';

      generatePDFFromHTML(contentHTML, filename, function () {
        btn.innerHTML = originalContent;
        btn.style.opacity = '';
        btn.style.cursor = '';
        btn.style.pointerEvents = '';
      });
    });
  }
}

function generatePDFFromHTML(htmlContent, filename, onComplete) {
  if (!window.jspdf || !window.html2canvas) {
    console.error('jsPDF or html2canvas not loaded');
    if (onComplete) onComplete();
    return;
  }

  const { jsPDF } = window.jspdf;

  const container = document.createElement('div');
  container.style.position = 'fixed';
  container.style.left = '0';
  container.style.top = '0';
  container.style.zIndex = '-10000';
  container.style.width = '700px';
  container.style.fontFamily = "Arial, sans-serif";
  container.style.background = '#ffffff';
  container.style.padding = '40px';
  container.style.color = '#000000';
  container.id = 'pdf-content-generator';

  container.innerHTML = htmlContent;
  document.body.appendChild(container);

  // Allow images to load
  const images = container.getElementsByTagName('img');
  let loadedCount = 0;

  function proceed() {
    (async function run() {
      try {
        const doc = new jsPDF({
          orientation: 'p',
          unit: 'pt',
          format: 'a4'
        });

        const pageHeight = 842;
        const margin = 40;
        const contentWidth = 515;

        let y = margin;

        const wrapper = container.firstElementChild;
        const elements = Array.from(wrapper.getElementsByClassName('pdf-block'));

        for (const element of elements) {
          const canvas = await window.html2canvas(element, {
            useCORS: true,
            scale: 2,
            backgroundColor: '#ffffff'
          });

          const imgData = canvas.toDataURL('image/jpeg', 0.95);
          const imgHeight = (canvas.height * contentWidth) / canvas.width;

          if (y + imgHeight > pageHeight - margin) {
            doc.addPage();
            y = margin;
          }

          doc.addImage(imgData, 'JPEG', margin, y, contentWidth, imgHeight);
          y += imgHeight;
        }

        doc.save(filename);
      } catch (e) {
        console.error('PDF generation error', e);
      } finally {
        if (document.body.contains(container)) document.body.removeChild(container);
        if (onComplete) onComplete();
      }
    })();
  }

  if (images.length === 0) {
    proceed();
  } else {
    // Wait for images to load
    for (let i = 0; i < images.length; i++) {
      if (images[i].complete) {
        loadedCount++;
        if (loadedCount === images.length) proceed();
      } else {
        images[i].onload = function () {
          loadedCount++;
          if (loadedCount === images.length) proceed();
        };
        images[i].onerror = function () {
          // Proceed even if image fails
          loadedCount++;
          if (loadedCount === images.length) proceed();
        }
      }
    }
  }
}

function getFooterHTML() {
  // Dynamic footer with Logo and Contacts
  const logoUrl = (typeof pdfSettings !== 'undefined' && pdfSettings.logoUrl)
    ? pdfSettings.logoUrl
    : window.location.origin + '/wp-content/themes/elinar-plast/assets/images/logo-color-200.webp';

  return `
      <div class="pdf-block" style="padding: 10px; background: #fff; margin-top: 20px;">
          <hr style="margin: 0 0 20px 0; border: 0; border-top: 2px solid #000;">
          <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
              <tr>
                  <td style="vertical-align: top; width: 40%;">
                      <img src="${logoUrl}" crossorigin="anonymous" style="width: 120px; display: block; margin-bottom: 10px;" alt="ElinarPlast">
                      <div style="font-size: 10px; color: #666; line-height: 1.4;">
                          Производство полимерных профилей<br>
                          для промышленности и строительства
                      </div>
                  </td>
                  <td style="vertical-align: top; width: 60%; text-align: right; font-size: 10px; color: #000; line-height: 1.5;">
                      <div style="margin-bottom: 5px;">
                          <strong>Тел:</strong> +7 (496) 34-77-944 <span style="color: #ccc;">|</span> <strong>Email:</strong> plast@elinar.ru
                      </div>
                      <div>
                          143322, Московская область, Наро-Фоминский городской округ,<br>
                          село Атепцево, площвдь Купца Алешина, вл. №1
                      </div>
                  </td>
              </tr>
          </table>
      </div>
    `;
}

function getPVCContent() {
  return `
      <div id="pdf-wrapper" style="font-family: Arial, sans-serif; line-height: 1.5; font-size: 14px; color: #000000; background-color: #ffffff; padding: 20px;">

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h1 style="text-align: center; font-size: 22px; font-weight: bold; margin: 0; color: #000000; text-transform: uppercase;">ТЕХНИЧЕСКИЕ ТРЕБОВАНИЯ И СПЕЦИФИКАЦИЯ ПРОДУКЦИИ</h1>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h2 style="text-align: center; font-size: 18px; font-weight: bold; margin: 0; color: #000000;">Термовставки из ударопрочного ПВХ для фасадных систем</h2>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">1. Общее описание</h3>
              <p style="margin: 0 0 10px 0; text-align: justify; color: #000000;">Термовставки (термомосты) представляют собой профильные изделия из ударопрочного поливинилхлорида (ПВХ), предназначенные для создания терморазрыва в алюминиевых фасадных, оконных и дверных системах. Изделия производятся методом экструзии по индивидуальным чертежам заказчика.</p>
              <p style="margin: 0; text-align: justify; color: #000000;">Продукция обеспечивает высокую энергоэффективность конструкций, стабильность геометрии при климатических нагрузках и точность сопряжения элементов.</p>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">2. Характеристики материала</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Для производства используется специальная композиция ударопрочного ПВХ, обладающая следующими свойствами:</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Механическая прочность:</strong> Высокая стойкость к ударным нагрузкам и деформации при монтаже и эксплуатации.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Климатическая стойкость:</strong> Материал стабилизирован к воздействию ультрафиолетового излучения (УФ), не выцветает и не разрушается на солнце.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Температурный режим:</strong> Сохранение рабочих характеристик при резких перепадах температур (морозостойкость и теплостойкость).</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Теплотехника:</strong> Низкий коэффициент теплопроводности для обеспечения требуемого уровня термоизоляции фасадной системы.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Поверхность:</strong> Гладкая, однородная поверхность без посторонних включений, обеспечивающая плотное прилегание уплотнителей.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">3. Требования к геометрии и допускам</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Мы специализируемся на профилях сложной геометрии (многокамерные, функциональные).</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Стабильность:</strong> Технология экструзии гарантирует отсутствие коробления и продольной деформации.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Точность:</strong> Изготовление производится в строгом соответствии с чертежами. Допуски на размеры соответствуют классу точности для профильных изделий из ПВХ (согласно ГОСТ или DIN, в зависимости от ТЗ).</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Повторяемость:</strong> Автоматизированное оборудование обеспечивает идеальную повторяемость сечения от партии к партии.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">4. Области применения</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Термовставки применяются в качестве конструктивных элементов в следующих системах:</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Фасадные алюминиевые стоечно-ригельные системы.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>«Теплые» оконные и дверные алюминиевые блоки.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Светопрозрачные зенитные фонари, купола и атриумы.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Конструкции зимних садов.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">5. Требования к оформлению заказа (Входные данные)</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Для запуска производства термовставок по индивидуальным параметрам («под задачу») Заказчику необходимо предоставить:</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;">
                      <span style="position: absolute; left: 0;">•</span><strong>Чертежи профиля:</strong>
                      <ul style="list-style-type: none; padding-left: 10px; margin-top: 5px; font-size: 14px; color: #000000;">
                          <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">-</span>Форматы файлов: .DWG, .DXF (AutoCAD) или .PDF (с указанием всех размеров).</li>
                          <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">-</span>Масштаб: 1:1.</li>
                      </ul>
                  </li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;">
                      <span style="position: absolute; left: 0;">•</span><strong>Техническое задание:</strong>
                      <ul style="list-style-type: none; padding-left: 10px; margin-top: 5px; font-size: 14px; color: #000000;">
                          <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">-</span>Требуемые механические характеристики (если отличаются от стандартных).</li>
                          <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">-</span>Особые требования к допускам сопряжения.</li>
                          <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">-</span>Длина хлыстов (стандартная или в нарезку).</li>
                      </ul>
                  </li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Объем партии:</strong> Ориентировочный метраж для расчета стоимости и сроков.</li>
              </ul>
          </div>

           <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">6. Этапы работы над проектом</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Мы обеспечиваем полное сопровождение проекта:</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Разработка:</strong> Анализ чертежей инженером-технологом, проверка на технологичность экструзии.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Адаптация:</strong> Учет особенностей конкретной фасадной системы, внесение рекомендаций по оптимизации геометрии.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Подбор материала:</strong> Утверждение состава смеси для достижения нужного баланса жесткости и теплопроводности.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Производство:</strong> Изготовление фильеры (при необходимости), выпуск опытной партии, контроль качества и запуск серийного производства.</li>
              </ul>
          </div>

          ` + getFooterHTML() + `
      </div>
  `;
}

function getChamferContent() {
  return `
      <div id="pdf-wrapper" style="font-family: Arial, sans-serif; line-height: 1.5; font-size: 14px; color: #000000; background-color: #ffffff; padding: 20px;">

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h1 style="text-align: center; font-size: 22px; font-weight: bold; margin: 0; color: #000000; text-transform: uppercase;">ТЕХНИЧЕСКАЯ СПЕЦИФИКАЦИЯ ИЗДЕЛИЯ</h1>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h2 style="text-align: center; font-size: 18px; font-weight: bold; margin: 0; color: #000000;">Фаскообразователи для опалубочных систем и производства ЖБИ</h2>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">1. Назначение и описание</h3>
              <p style="margin: 0 0 10px 0; text-align: justify; color: #000000;">Фаскообразователь (профиль для формирования фаски) — это погонажное изделие из ударопрочного полимера, предназначенное для установки в опалубочные формы.</p>
              <p style="margin: 0; text-align: justify; color: #000000;">Основная функция: формирование скошенного угла (фаски) на гранях железобетонных изделий, колонн, свай и ригелей. Профиль обеспечивает герметичность стыков опалубки, предотвращает вытекание цементного молочка и защищает углы готового изделия от сколов.</p>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">2. Материал и характеристики</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Изделия изготавливаются из композитного ударопрочного ПВХ (жесткий компаунд).</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Химическая стойкость:</strong> Инертность к щелочной среде бетона и смазкам.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Износостойкость:</strong> Устойчив к абразивному воздействию.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Ударная вязкость:</strong> Сохраняет целостность при виброукладке.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Температурный диапазон:</strong> от -40°С до +60°С.</li>
                  <li style="margin-bottom: 0px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Оборачиваемость:</strong> Пригодно для многоразового использования.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">3. Преимущества использования</h3>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Идеальная геометрия:</strong> Точный и эстетичный срез угла.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Защита от брака:</strong> Снижение сколов при распалубке.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Легкость монтажа:</strong> Гладкая поверхность не имеет адгезии к бетону.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Экономичность:</strong> Долговечность материала.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">4. Типоразмеры и конфигурации</h3>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Основные типы:</strong> Треугольный профиль, профиль с крепежной полкой, радиусный профиль.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Стандартные размеры (катеты):</strong> 10х10, 15х15, 20х20, 25х25, 30х30 мм.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Индивидуальное производство:</strong> Любая конфигурация по чертежам.</li>
              </ul>
          </div>

          <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">5. Рекомендации по эксплуатации</h3>
               <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Монтаж:</strong> Гвозди, саморезы, клей или зажим опалубкой.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Смазка:</strong> Рекомендуется использование опалубочной смазки.</li>
                  <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span><strong>Хранение:</strong> В горизонтальном положении на ровной поверхности.</li>
              </ul>
          </div>

           <div class="pdf-block" style="padding: 10px; background: #fff;">
              <h3 style="font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #000000;">6. Данные для заказа</h3>
              <p style="margin: 0 0 10px 0; color: #000000;">Для оформления заявки укажите:</p>
              <ul style="list-style-type: none; padding-left: 0; margin: 0; color: #000000;">
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Тип сечения.</li>
                  <li style="margin-bottom: 5px; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Размер катета фаски (мм).</li>
                   <li style="margin-bottom: 0; padding-left: 15px; position: relative;"><span style="position: absolute; left: 0;">•</span>Длина хлыста и общий объем партии.</li>
              </ul>
          </div>

          ` + getFooterHTML() + `
      </div>
  `;
}
