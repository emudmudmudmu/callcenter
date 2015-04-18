@extends('layouts.home', [
	'page_title' => '登録情報の変更'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="registration">
                <h2 class="h">{{ HTML::image('home/assets/img/form/h_registration_change.png', '登録情報の変更', ['width' => '750', 'height' => '95']) }}</h2>
                <p class="btn-r"><a href="withdraw.html">{{ HTML::image('home/assets/img/form/btn_to_withdraw.png', '退会はこちらから', ['width' => '145', 'height' => '24']) }}</a></p>
                <div class="formbox">
                    <form>
                        <h3>基本情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>名前　<span class="required">[必須]</span></th>
                                <td><input type="text" name="name" value=""></td>
                            </tr>
                            <tr>
                                <th>ふりがな　<span class="required">[必須]</span></th>
                                <td><input type="text" name="name2" value=""></td>
                            </tr>
                            <tr>
                                <th class="va-top">住所　<span class="required">[必須]</span></th>
                                <td>
                                    <dl>
                                        <dt>郵便番号</dt>
                                        <dd>〒<input type="text" name="zip" value="" class="zip2"></dd>
                                        <dt>都道府県</dt>
                                        <dd>
                                            <select name="pref" class="pref">
                                                <option>都道府県を選択してください</option>
                                                <option value="北海道">北海道</option>
                                                <option value="青森">青森</option>
                                                <option value="岩手">岩手</option>
                                                <option value="宮城">宮城</option>
                                                <option value="秋田">秋田</option>
                                                <option value="山形">山形</option>
                                                <option value="福島">福島</option>
                                                <option value="東京">東京</option>
                                                <option value="神奈川">神奈川</option>
                                                <option value="埼玉">埼玉</option>
                                                <option value="千葉">千葉</option>
                                                <option value=" 茨城"> 茨城</option>
                                                <option value="栃木">栃木</option>
                                                <option value="群馬">群馬</option>
                                                <option value="新潟">新潟</option>
                                                <option value="富山">富山</option>
                                                <option value="石川">石川</option>
                                                <option value="福井">福井</option>
                                                <option value="山梨">山梨</option>
                                                <option value="長野">長野</option>
                                                <option value="愛知">愛知</option>
                                                <option value="岐阜">岐阜</option>
                                                <option value="静岡">静岡</option>
                                                <option value="三重">三重</option>
                                                <option value="大阪">大阪</option>
                                                <option value="兵庫">兵庫</option>
                                                <option value="京都">京都</option>
                                                <option value="滋賀">滋賀</option>
                                                <option value="奈良">奈良</option>
                                                <option value="和歌山">和歌山</option>
                                                <option value="鳥取">鳥取</option>
                                                <option value="島根">島根</option>
                                                <option value="岡山">岡山</option>
                                                <option value="広島">広島</option>
                                                <option value="山口">山口</option>
                                                <option value="徳島">徳島</option>
                                                <option value="香川">香川</option>
                                                <option value="愛媛">愛媛</option>
                                                <option value="高知">高知</option>
                                                <option value="福岡">福岡</option>
                                                <option value="佐賀">佐賀</option>
                                                <option value="長崎">長崎</option>
                                                <option value="熊本">熊本</option>
                                                <option value="大分">大分</option>
                                                <option value="宮崎">宮崎</option>
                                                <option value="鹿児島">鹿児島</option>
                                                <option value="沖縄">沖縄</option>
                                            </select>
                                        </dd>
                                        <dt>市区町村</dt>
                                        <dd><input type="text" name="address1" value=""></dd>
                                        <dt>以降住所</dt>
                                        <dd><input type="text" name="address2" value=""></dd>
                                        <dt>マンション等</dt>
                                        <dd><input type="text" name="address3" value=""></dd>
                                    </dl>
                                </td>
                            </tr>
                            <tr>
                                <th>生年月日　<span class="required">[必須]</span></th>
                                <td>
                                    <select name="year">
                                        <option>選択</option>
                                        <option value="1940">1940</option>
                                        <option value="1941">1941</option>
                                        <option value="1943">1943</option>
                                        <option value="1944">1944</option>
                                        <option value="1945">1945</option>
                                        <option value="1946">1946</option>
                                        <option value="1947">1947</option>
                                        <option value="1948">1948</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1953">1953</option>
                                        <option value="1954">1954</option>
                                        <option value="1955">1955</option>
                                        <option value="1956">1956</option>
                                        <option value="1957">1957</option>
                                        <option value="1958">1958</option>
                                        <option value="1959">1959</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                    </select>
                                    年　
                                    <select name="month">
                                        <option>選択</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    月　
                                    <select name="day">
                                        <option>選択</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    日
                                </td>
                            </tr>
                            <tr>
                                <th>性別　<span class="required">[必須]</span></th>
                                <td><input type="radio" name="sex" value="男性">男性　<input type="radio" name="sex" value="女性">女性</td>
                            </tr>
                            <tr>
                                <th>電話番号　<span class="required">[必須]</span></th>
                                <td><input type="text" name="tel" value=""></td>
                            </tr>
                            <tr>
                                <th>メールアドレス　<span class="required">[必須]</span></th>
                                <td><input type="text" name="mailaddress" value=""></td>
                            </tr>
                        </table>
                        <h3>経歴情報</h3>
                        <table class="apply-table">
                            <tr>
                                <th>現在の職業</th>
                                <td><input type="text" name="job" value=""></td>
                            </tr>
                            <tr>
                                <th>最終学歴</th>
                                <td><input type="text" name="education" value=""></td>
                            </tr>
                            <tr>
                                <th class="va-top">保有資格</th>
                                <td><textarea name="license" cols="40" rows="5"></textarea></td>
                            </tr>
                            <tr>
                                <th class="va-top">職務経歴</th>
                                <td><textarea name="profile" cols="40" rows="5"></textarea></td>
                            </tr>
                            <tr>
                                <th class="va-top">自己PR</th>
                                <td><textarea name="pr" cols="40" rows="5"></textarea></td>
                            </tr>
                        </table>
                        <h3>パスワードの設定</h3>
                        <table class="apply-table mb0">
                            <tr>
                                <th>パスワード <span class="required">[必須]</span></th>
                                <td><input type="password" name="pw" value=""> ご希望の半角英数字6文字以上</td>
                            </tr>
                            <tr>
                                <th>パスワード（確認用） <span class="required">[必須]</span></th>
                                <td><input type="password" name="pw2" value=""> 上記と同じものを確認のために入力して下さい。</td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="home/assets/img/form/btn_confirm.png" alt="確認"></p>
                    </form>
                </div>
            </div>
        </section><!-- /.l-main -->

@stop