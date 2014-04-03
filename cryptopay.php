<?php

/* Class */
class Cryptopay
{
	const URL       = 'https://cryptopay.me/api/v1';
	const VERSION   = '1.0';
	private $api_key;

	function Cryptopay ($key)
	{
		$this->api_key = $key;
	}

	private function request ($method, $url, $data)
	{
		if (isset($data['callback_params']))
		{
			foreach($data['callback_params'] AS $name => $value)
			{
				$data["callback_params[$name]"] = $value;
			}

			unset($data['callback_params']);
		}

		$data['api_key'] = $this->api_key;

		try
		{
			if (!$curl = curl_init())
			{
				throw new Exception('Module CURL is not initialized');
			}

			curl_setopt($curl, CURLOPT_URL, self::URL . $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Cryptopay PHP API Client '. self::VERSION);

			if (!$out = curl_exec($curl))
			{
				$error = json_encode(curl_error($curl) .' ('. curl_errno($curl) .')');
				throw new Exception($error);
			}

			$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			if (!($response_code >= 200 && $response_code < 300))
			{
				$errors['error_code'] = $response_code;
				if (is_object(json_decode($out)) && !empty($out))
				{
					foreach (json_decode($out) AS $error_name => $error_mess)
					{
						$errors[$error_name] = ($error_name != 'error') ? $error_mess[0] : $error_mess;
					}
				}
				throw new Exception(json_encode($errors));
			}

			curl_close($curl);
		}
		catch (Exception $e)
		{
			$out = $e->getMessage();
		}

		return json_decode($out, true);
	}

	public function invoice ($data)
	{
		return $this->request('POST', '/invoices', $data);
	}
}