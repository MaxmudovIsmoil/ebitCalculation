
<div class="paper-container">
    <div class="table-container">
        <table>
            <tr>
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="numbers">
                                <div class="header"></div>
                            </td>
                            <td colspan="3" class="common-border">
                                <div class="header" style="padding-left: 5px; padding-right: 5px;">
                                    Заявка на организацию абонентской линии / Application form on organization of subscriber line
                                </div>
                            </td>
                        </tr>
                        <tr class="common-border">
                            <td rowspan="4" class="numbers">1</td>
                            <td class="common-border title-column">
                                <div class="title-container">
                                    <div class="bot-border centering-content">
                                        <strong>Name of ET department:</strong>
                                    </div>
                                    <div class="centering-content">
                                        Подразделение «Ist Telekom»
                                    </div>
                                </div>
                            </td>
                            <td class="common-border" style="width:420px;"><div class="centering-content"><strong>Отдел продаж</strong></div></td>
                            <td class="common-border" ><div class="centering-content">Date: {{ $order['date'] }} г.</div></td>
                        </tr>

                        <tr>
                            <td  class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Subscriber line project</strong></div>
                                    <div class="centering-content">Объект абонентской линии</div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <strong>Заказчик: {{ $order['client'] }}</strong>
                                    </div>
                                    <div>
                                        <strong>Адрес: {{ $order['address'] }}</strong>
                                    </div>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Preliminary cost </strong></div>
                                    <div class="centering-content">Предварительная стоимость </div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <strong>{!! $order['preliminaryCost'] !!}</strong>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>№ оf Contract, payment for the organization of the subscriber line, monthly income for services</strong></div>
                                    <div class="centering-content">№ Договора, оплата за организацию абонентской линии, месячный доход за услуги</div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <strong>{!! $order['contractPayment'] !!}</strong>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="numbers">2</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Payback period </strong></div>
                                    <div class="centering-content">Срок окупаемости</div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        ______________________________________________________________
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>The basis </strong></div>
                                    <div class="centering-content">Основание </div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        ______________________________________________________________
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="numbers">3</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Date of term:</strong></div>
                                    <div class="centering-content">Срок(и) окончания </div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <strong>«{{ $order['dueDay'] ?? '___' }}» рабочих дней с / без учета запретов </strong> 
                                        <div class="signature-container">
                                            <div class="signature-title">  Director of NCD <strong>Almatov N </strong></div>
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="numbers">4</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Adjustment of final layout</strong></div>
                                    <div class="centering-content">Утверждение окончательной схемы</div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title">  Head of Technical Department <strong>Khodjageldiev K.K. </strong></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="numbers">5</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container centering-content">
                                    <strong>Responsible Party:</br></strong>
                                    Исполнитель:
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-title">   Specialist of Sales Departmen  </div>
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title"> <strong>Nazarova K.О </strong></div>
                                        </div>
                                    </div>
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-title">  Director of Sales Department    </div>
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title"> <strong> Narhodjaev S.     </strong></div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="numbers">6</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container centering-content">
                                    <strong>Adjustment:</br></strong>
                                    Согласования:
                                </div>

                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title"> Deputy General Director <strong>Nazarova K.О </strong></div>
                                        </div>
                                    </div>
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title">Deputy General Director <strong>Tuychiev H.J. </strong></div>
                                        </div>
                                    </div>
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title">Deputy General Director <strong>Lim Won Suk </strong></div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="numbers">7</td>
                            <td colspan="1" class="common-border">
                                <div class="title-container">
                                    <div class="bot-border centering-content"><strong>Resolution of General Director of EAST TELECOM:</strong></div>
                                    <div class="centering-content">Резолюция Генерального Директора IST TELEKOM </div>
                                </div>
                            </td>
                            <td colspan="2" class="common-border">
                                <div class="value-container">
                                    <div class="value-item">
                                        <div class="signature-container">
                                            <div class="signature-line-container">
                                                <div class="signature-line"></div>
                                                <div class="signature-placeholder">(подпись)</div>
                                            </div>
                                            <div class="signature-title">  General Director <strong>Kim Sungmin</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

