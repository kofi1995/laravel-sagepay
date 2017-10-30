<?php
/**
 * SagePay Class for Form Integration Method, utilizes Protocol V3
 *
 * @author    Timur Olzhabayev, modified by Kofi Kwarteng for Laravel 5.x
 * @copyright Copyright (c) 2016 Kofi Kwarteng
 * @link      https://github.com/kofispaceman/laravel-sagepay
 * @license   http://www.opensource.org/licenses/mit-license.php
 */

namespace Kofikwarteng\LaravelSagepay;

/**
 * Class SagePay
 *
 * @property string $vendorTxCode
 * @property string $amount
 * @property string $currency
 * @property string $description
 * @property string $successURL
 * @property string $failureURL
 * @property string $customerName
 * @property string $customerEMail
 * @property string $vendorEMail
 * @property string $sendEMail
 * @property string $eMailMessage
 * @property string $billingSurname
 * @property string $billingFirstnames
 * @property string $billingAddress1
 * @property string $billingAddress2
 * @property string $billingPostCode
 * @property string $billingCountry
 * @property string $billingCity
 * @property string $billingState
 * @property string $billingPhone
 * @property string $deliverySurname
 * @property string $deliveryFirstnames
 * @property string $deliveryAddress1
 * @property string $deliveryAddress2
 * @property string $deliveryCity
 * @property string $deliveryPostCode
 * @property string $deliveryCountry
 * @property string $deliveryState
 * @property string $deliveryPhone
 * @property string $basket
 * @property string $allowGiftAid
 * @property string $applyAVSCV2
 * @property string $apply3DSecure
 * @property string $billingAgreement
 * @property string $basketXML
 * @property string $customerXML
 * @property string $surchargeXML
 * @property string $vendorData
 * @property string $referrerID
 * @property string $language
 * @property string $website
 */
/**
 * Class SagePay
 *
 * @package Kofikwarteng\LaravelSagepay
 */
class SagePay
{
//declaring variables we are going to work with, remember, some are optional, refer to github's example as the required fields
    /**
     * @var
     */
    protected $vendorTxCode;
    /**
     * @var
     */
    protected $amount;
    /**
     * @var
     */
    protected $currency;
    /**
     * @var
     */
    protected $description;
    /**
     * @var
     */
    protected $successURL;
    /**
     * @var
     */
    protected $failureURL;
    /**
     * @var
     */
    protected $customerName;
    /**
     * @var
     */
    protected $customerEMail;
    /**
     * @var
     */
    protected $vendorEMail;
    /**
     * @var
     */
    protected $sendEMail;
    /**
     * @var
     */
    protected $eMailMessage;
    /**
     * @var
     */
    protected $billingSurname;
    /**
     * @var
     */
    protected $billingFirstnames;
    /**
     * @var
     */
    protected $billingAddress1;
    /**
     * @var
     */
    protected $billingAddress2;
    /**
     * @var
     */
    protected $billingPostCode;
    /**
     * @var
     */
    protected $billingCountry;
    /**
     * @var
     */
    protected $billingCity;
    /**
     * @var
     */
    protected $billingState;
    /**
     * @var
     */
    protected $billingPhone;
    /**
     * @var
     */
    protected $deliverySurname;
    /**
     * @var
     */
    protected $deliveryFirstnames;
    /**
     * @var
     */
    protected $deliveryAddress1;
    /**
     * @var
     */
    protected $deliveryAddress2;
    /**
     * @var
     */
    protected $deliveryCity;
    /**
     * @var
     */
    protected $deliveryPostCode;
    /**
     * @var
     */
    protected $deliveryCountry;
    /**
     * @var
     */
    protected $deliveryState;
    /**
     * @var
     */
    protected $deliveryPhone;
    /**
     * @var
     */
    protected $basket;
    /**
     * @var
     */
    protected $allowGiftAid;
    /**
     * @var
     */
    protected $applyAVSCV2;
    /**
     * @var
     */
    protected $apply3DSecure;
    /**
     * @var
     */
    protected $billingAgreement;
    /**
     * @var
     */
    protected $basketXML;
    /**
     * @var
     */
    protected $customerXML;
    /**
     * @var
     */
    protected $surchargeXML;
    /**
     * @var
     */
    protected $vendorData;
    /**
     * @var
     */
    protected $referrerID;
    /**
     * @var
     */
    protected $language;
    /**
     * @var
     */
    protected $website;

    /**
     * SagePay constructor.
     * Anytime the object is created, create a VendorTxCode. This code should be unique at all times.
     */
    public function __construct()
    {
        $this->setVendorTxCode($this->createVendorTxCode());
        $this->setCurrency(config('sagepay.currency'));
    }

    /**
     * get encryption string. Sagepay uses this string to identify your payment
     *
     * @return string
     */
    public function getCrypt()
    {
        $cryptString = 'VendorTxCode=' . $this->getVendorTxCode();
        $cryptString .= '&ReferrerID=' . $this->getReferrerID();
        $cryptString .= '&Amount=' . $this->getAmount();
        $cryptString .= '&Currency=' . $this->getCurrency();
        $cryptString .= '&Description=' . $this->getDescription();
        $cryptString .= '&SuccessURL=' . $this->getSuccessURL();
        $cryptString .= '&FailureURL=' . $this->getFailureURL();
        $cryptString .= '&CustomerName=' . $this->getCustomerName();
        $cryptString .= '&CustomerEMail=' . $this->getCustomerEMail();
        $cryptString .= '&VendorEMail=' . $this->getVendorEMail();
        $cryptString .= '&SendEMail=' . $this->getSendEMail();
        $cryptString .= '&eMailMessage=' . $this->getEMailMessage();
        $cryptString .= '&BillingSurname=' . $this->getBillingSurname();
        $cryptString .= '&BillingFirstnames=' . $this->getBillingFirstnames();
        $cryptString .= '&BillingAddress1=' . $this->getBillingAddress1();
        $cryptString .= '&BillingAddress2=' . $this->getBillingAddress2();
        $cryptString .= '&BillingCity=' . $this->getBillingCity();
        $cryptString .= '&BillingPostCode=' . $this->getBillingPostCode();
        $cryptString .= '&BillingCountry=' . $this->getBillingCountry();
        $cryptString .= '&BillingState=' . $this->getBillingState();
        $cryptString .= '&BillingPhone=' . $this->getBillingPhone();
        $cryptString .= '&DeliverySurname=' . $this->getDeliverySurname();
        $cryptString .= '&DeliveryFirstnames=' . $this->getDeliveryFirstnames();
        $cryptString .= '&DeliveryAddress1=' . $this->getDeliveryAddress1();
        $cryptString .= '&DeliveryAddress2=' . $this->getDeliveryAddress2();
        $cryptString .= '&DeliveryCity=' . $this->getDeliveryCity();
        $cryptString .= '&DeliveryPostCode=' . $this->getDeliveryPostCode();
        $cryptString .= '&DeliveryCountry=' . $this->getDeliveryCountry();
        $cryptString .= '&DeliveryState=' . $this->getDeliveryState();
        $cryptString .= '&DeliveryPhone=' . $this->getDeliveryPhone();
        $cryptString .= '&Basket=' . $this->getBasket();
        $cryptString .= '&AllowGiftAid=' . $this->getAllowGiftAid();
        $cryptString .= '&ApplyAVSCV2=' . $this->getApplyAVSCV2();
        $cryptString .= '&Apply3DSecure=' . $this->getApply3DSecure();
        $cryptString .= '&BillingAgreement=' . $this->getBillingAgreement();
        $cryptString .= '&BasketXML=' . $this->getBasketXML();
        $cryptString .= '&CustomerXML=' . $this->getCustomerXML();
        $cryptString .= '&SurchargeXML=' . $this->getSurchargeXML();
        $cryptString .= '&VendorData=' . $this->getVendorData();
        $cryptString .= '&ReferrerID=' . $this->getReferrerID();
        $cryptString .= '&Language=' . $this->getLanguage();
        $cryptString .= '&Website=' . $this->getWebsite();


        return $this->encryptAndEncode($cryptString);

    }

    /**
     * Create random string to be used as the VendorTxCode, it should not contain more than 40 characters
     *
     * @return string
     */
    protected function createVendorTxCode()
    {
        $timestamp = date("y-m-d-H-i-s", time());
        $random_number = rand(0, 32000) * rand(0, 32000);

        return "{$timestamp}-{$random_number}";
    }

    /**
     * Code from here to next comment is to get and set the various sagepay parameters needed for payment
     * Function names are self explanatory
     * If you don't understand any of them, google their names with reference to sagepay. You would get information on them
     **/
// <editor-fold desc="Getters and Setters">

    /**
     * Expects a valid currency eg.GBP
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = strtoupper($currency);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setVendorTxCode($code)
    {
        $this->vendorTxCode = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorTxCode()
    {
        return $this->vendorTxCode;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = number_format($amount, 2);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getSuccessURL()
    {
        return $this->successURL;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setSuccessURL($url)
    {
        $this->successURL = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFailureURL()
    {
        return $this->failureURL;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setFailureURL($url)
    {
        $this->failureURL = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = mb_substr($description, 0, 100);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setCustomerName($name)
    {
        $this->customerName = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerEMail()
    {
        return $this->customerEMail;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setCustomerEMail($email)
    {
        $this->customerEMail = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorEMail()
    {
        return $this->vendorEMail;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setVendorEMail($email)
    {
        $this->vendorEMail = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSendEMail()
    {
        return $this->sendEMail;
    }

    /**
     * @param int $sendEmail
     * @return $this
     */
    public function setSendEMail($sendEmail = 1)
    {
        $this->sendEMail = $sendEmail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEMailMessage()
    {
        return $this->eMailMessage;
    }

    /**
     * @param $emailMessage
     * @return $this
     */
    public function setEMailMessage($emailMessage)
    {
        $this->eMailMessage = $emailMessage;

        return $this;
    }

    /**
     * @param $billingFirstnames
     * @return $this
     */
    public function setBillingFirstnames($billingFirstnames)
    {
        $this->billingFirstnames = $billingFirstnames;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingFirstnames()
    {
        return $this->billingFirstnames;
    }

    /**
     * @param $billingSurname
     * @return $this
     */
    public function setBillingSurname($billingSurname)
    {
        $this->billingSurname = $billingSurname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingSurname()
    {
        return $this->billingSurname;
    }

    /**
     * @param $billingAddress1
     * @return $this
     */
    public function setBillingAddress1($billingAddress1)
    {
        $this->billingAddress1 = $billingAddress1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress1()
    {
        return $this->billingAddress1;
    }

    /**
     * @param $billingAddress2
     * @return $this
     */
    public function setBillingAddress2($billingAddress2)
    {
        $this->billingAddress2 = $billingAddress2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress2()
    {
        return $this->billingAddress2;
    }

    /**
     * @param $billingCity
     * @return $this
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * @param $billingPostCode
     * @return $this
     */
    public function setBillingPostCode($billingPostCode)
    {
        $this->billingPostCode = $billingPostCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingPostCode()
    {
        return $this->billingPostCode;
    }

    /**
     * @param $billingState
     * @return $this
     */
    public function setBillingState($billingState)
    {
        $this->billingState = $billingState;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingState()
    {
        return $this->billingState;
    }

    /**
     * @return mixed
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    /**
     * @param $countryISO3166
     * @return $this
     */
    public function setBillingCountry($countryISO3166)
    {
        $this->billingCountry = strtoupper($countryISO3166);

        return $this;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function setBillingPhone($phone)
    {
        $this->billingPhone = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    /**
     * @param $surname
     * @return $this
     */
    public function setDeliverySurname($surname)
    {
        $this->deliverySurname = $surname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliverySurname()
    {
        return $this->deliverySurname;
    }


    /**
     * @param $firstnames
     * @return $this
     */
    public function setDeliveryFirstnames($firstnames)
    {
        $this->deliveryFirstnames = $firstnames;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryFirstnames()
    {
        return $this->deliveryFirstnames;
    }

    /**
     * @param $address
     * @return $this
     */
    public function setDeliveryAddress1($address)
    {
        $this->deliveryAddress1 = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress1()
    {
        return $this->deliveryAddress1;
    }

    /**
     * @param $address
     * @return $this
     */
    public function setDeliveryAddress2($address)
    {
        $this->deliveryAddress2 = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress2()
    {
        return $this->deliveryAddress2;
    }

    /**
     * @param $city
     * @return $this
     */
    public function setDeliveryCity($city)
    {
        $this->deliveryCity = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    /**
     * @param $zip
     * @return $this
     */
    public function setDeliveryPostCode($zip)
    {
        $this->deliveryPostCode = $zip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryPostCode()
    {
        return $this->deliveryPostCode;
    }

    /**
     * @param $country
     * @return $this
     */
    public function setDeliveryCountry($country)
    {
        $this->deliveryCountry = strtoupper($country);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }


    /**
     * @param $state
     * @return $this
     */
    public function setDeliveryState($state)
    {
        $this->deliveryState = $state;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryState()
    {
        return $this->deliveryState;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function setDeliveryPhone($phone)
    {
        $this->deliveryPhone = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    /**
     * @param $basket
     * @return $this
     */
    public function setBasket($basket)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param int $allowGiftAid
     * @return $this
     */
    public function setAllowGiftAid($allowGiftAid = 0)
    {
        $this->allowGiftAid = $allowGiftAid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowGiftAid()
    {
        return $this->allowGiftAid;
    }

    /**
     * @param int $avsCV2
     * @return $this
     */
    public function setApplyAVSCV2($avsCV2 = 0)
    {
        $this->applyAVSCV2 = $avsCV2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplyAVSCV2()
    {
        return $this->applyAVSCV2;
    }

    /**
     * @param int $apply3DSecure
     * @return $this
     */
    public function setApply3DSecure($apply3DSecure = 0)
    {
        $this->apply3DSecure = $apply3DSecure;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApply3DSecure()
    {
        return $this->apply3DSecure;
    }


    /**
     * @param int $billingAgreement
     * @return $this
     */
    public function setBillingAgreement($billingAgreement = 0)
    {
        $this->billingAgreement = $billingAgreement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAgreement()
    {
        return $this->billingAgreement;
    }


    /**
     * @param $basketXML
     * @return $this
     */
    public function setBasketXML($basketXML)
    {
        $this->basketXML = $basketXML;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBasketXML()
    {
        return $this->basketXML;
    }

    /**
     * @param $customerXML
     * @return $this
     */
    public function setCustomerXML($customerXML)
    {
        $this->customerXML = $customerXML;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerXML()
    {
        return $this->customerXML;
    }

    /**
     * @param $surchargeXML
     * @return $this
     */
    public function setSurchargeXML($surchargeXML)
    {
        $this->surchargeXML = $surchargeXML;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurchargeXML()
    {
        return $this->surchargeXML;
    }

    /**
     * @param $vendorData
     * @return $this
     */
    public function setVendorData($vendorData)
    {
        $this->vendorData = $vendorData;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorData()
    {
        return $this->vendorData;
    }

    /**
     * @param $referrerID
     * @return $this
     */
    public function setReferrerID($referrerID)
    {
        $this->referrerID = $referrerID;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferrerID()
    {
        return $this->referrerID;
    }


    /**
     * @param $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }


    /**
     * @param $website
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

// </editor-fold>

    /**
     * Sets all the delivery details as the billing information
     */
    public function setDeliverySameAsBilling()
    {
        $this->setDeliverySurname($this->getBillingSurname());
        $this->setDeliveryFirstnames($this->getBillingFirstnames());
        $this->setDeliveryAddress1($this->getBillingAddress1());
        $this->setDeliveryAddress2($this->getBillingAddress2());
        $this->setDeliveryCity($this->getBillingCity());
        $this->setDeliveryPostCode($this->getBillingPostCode());
        $this->setDeliveryCountry($this->getBillingCountry());
        $this->setDeliveryState($this->getBillingState());
        $this->setDeliveryPhone($this->getBillingPhone());
    }

    /**
     * This is used to decode the response string SagePay attaches to the success/failure url. It is attached as a parameter with the name 'crypt'
     *
     * @param $strIn
     * @return mixed
     */
    public function decode($strIn)
    {
        $decodedString = $this->decodeAndDecrypt($strIn);
        parse_str($decodedString, $sagePayResponse);

        return $sagePayResponse;
    }

    /**
     * Code to encrypt the payment data being submitted to sagepay
     *
     * @param $strIn
     * @return string
     */
    protected function encryptAndEncode($strIn)
    {
        return "@" . bin2hex(openssl_encrypt($strIn, 'AES-128-CBC', config('sagepay.encryptPassword'), OPENSSL_RAW_DATA, config('sagepay.encryptPassword')));
    }


    /**
     * Code to decrypt the response string SagePay attaches to the failure or success URL
     *
     * @param $strIn
     * @return string
     */
    protected function decodeAndDecrypt($strIn)
    {
        $strIn = substr($strIn, 1);
        $strIn = pack('H*', $strIn);
        return openssl_decrypt($strIn, 'AES-128-CBC', config('sagepay.encryptPassword'), OPENSSL_RAW_DATA, config('sagepay.encryptPassword'));
    }
}